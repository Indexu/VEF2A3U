<?php

require('../totsekkidbcon/ekkidbcon.php');

class Ps2_Upload {

	protected $_uploaded = array();
	protected $_destination;
	protected $_max = 51200;
	protected $_messages = array();
	protected $_permitted = array('image/gif',
								  'image/jpeg',
								  'image/pjpeg',
								  'image/png');
	protected $_renamed = false;
	protected $_album;


	# Constructor
	public function __construct($path){
		if(!is_dir($path) || !is_writable($path)){
			throw new Exception("$path must be a valid, writable directory");
		}

		$this->_destination = $path;
		$this->_uploaded = $_FILES;

	}

	# Processa file
	protected function processFile($filename, $error, $size, $type, $tmp_name, $overwrite){
		$OK = $this->checkError($filename, $error);

		if($OK){

			$sizeOK = $this->checkSize($filename, $size);
			$typeOK = $this->checkType($filename, $type);

			if($sizeOK && $typeOK){
				$name = $this->checkName($filename, $overwrite);
				$success = move_uploaded_file($tmp_name, $this->_destination . $name);

				if($success){
					$this->createImageEntry($name);
					$message = $filename . ' uploaded successfully';

					if($this->_renamed){
						$message .= " and renamed $name";
					}

					$this->_messages[] = $message;
				}
				else{
					$this->_messages[] = 'Could not upload ' . $filename;
				}
				
			}
		}
	}

	# Move
	public function move($overwrite = false){
		$field = current($this->_uploaded);

		if(is_array($field['name'])){
			foreach ($field['name'] as $number => $filename) {
				$this->_renamed = false;
				$this->processFile($filename, $field['error'][$number], $field['size'][$number], $field['type'][$number], $field['tmp_name'][$number], $overwrite);
			}
		}
		else{
			$this->processFile($field['name'], $field['error'], $field['size'], $field['type'], $field['tmp_name'], $overwrite);
		}


	}

	# Check + insert image entry in DB
	protected function createImageEntry($name){
		global $pdo;

		$image = $this->_destination . $name;
		
		# Checka hvort að það sé núþegar til
		$query = "
            SELECT
                1
            FROM userimages
            WHERE
                url = :url
        ";

        $query_params = array(
            ':url' => $image
        );

        try
        {
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $row = $stmt->fetch();

        # Ef það er núþegar til
        if($row){
        	$this->_messages[] = "Image already has a database entry";
        	return;
        }
        # Ef ekki til
        else{
        	$finfo = finfo_open();
        	$imgType = finfo_file($finfo, $image, FILEINFO_MIME);
        	finfo_close($finfo);

        	$imgType = explode(";", $imgType);
        	$imgType = $imgType[0];

        	if($imgType == "image/jpeg" || $imgType == "image/pjpeg"){
        		$exifData = exif_read_data($image);
        	}
        	else{
        		list($width, $height) = getimagesize($image);

        		$exifData['FileName'] = basename($image);
        		$exifData['FileSize'] = filesize($image);
        		$exifData['MimeType'] = $imgType;
        		$exifData['COMPUTED']['Height'] = $height;
        		$exifData['COMPUTED']['Width'] = $width;
        	}

            $query = "
                INSERT INTO userimages (
                	userID,
                	albumID,
                	url,
                    fileName,
                    fileSize,
                    mime,
                    height,
                    width
                ) VALUES (
                	:userID,
                	:albumID,
                	:url,
                    :fileName,
                    :fileSize,
                    :mime,
                    :height,
                    :width
                )
            ";

            $query_params = array(
            	':userID' => $_SESSION['user']['userID'],
            	':albumID' => $this->_album,
            	':url' => $this->_destination . $exifData['FileName'],
                ':fileName' => $exifData['FileName'],
                ':fileSize' => $exifData['FileSize'],
                ':mime' => $exifData['MimeType'],
                ':height' => $exifData['COMPUTED']['Height'],
                ':width' => $exifData['COMPUTED']['Width']
            );

            # Inserta
            try
            {
                $stmt = $pdo->prepare($query);
                $result = $stmt->execute($query_params);
            }
            catch(PDOException $ex)
            {
                die("Failed to run query: " . $ex->getMessage());
            }

        }
	}

	# Check + create an album
	public function createAlbumEntry(){
		global $pdo;
		$album = basename($this->_destination);
		
		# Checka hvort að það sé núþegar til
		$query = "
            SELECT
                id
            FROM useralbums
            WHERE
                albumTitle = :albumTitle AND userID = :userID
        ";

        $query_params = array(
            ':albumTitle' => $album,
            ':userID' => $_SESSION['user']['userID']
        );

        try
        {
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $row = $stmt->fetch();

        # Ef það er núþegar til
        if($row){
        	$this->_album = $row['id'];
        	return;
        }
        # Ef ekki til
        else{

            $query = "
                INSERT INTO useralbums (
                    userID,
                    albumTitle
                ) VALUES (
                    :userID,
                    :albumTitle
                )
            ";

            $query_params = array(
                ':userID' => $_SESSION['user']['userID'],
                ':albumTitle' => $album
            );

            # Inserta
            try
            {
                $stmt = $pdo->prepare($query);
                $result = $stmt->execute($query_params);
            }
            catch(PDOException $ex)
            {
                die("Failed to run query: " . $ex->getMessage());
            }

            $this->_album = $pdo->lastInsertId('useralbums.id');

        }
	}

	# Get Messages
	public function getMessages(){
		return $this->_messages;
	}

	# Error codes
	protected function checkError($filename, $error){
		switch ($error) {
			case 0:
				return true;

			case 1:
			case 2:
				$this->_messages[] = "$filename esceeds maximum size: " . $this->getMaxSize();
				return true;

			case 3:
				$this->_messages[] = "Error uploading $filename. Please try again";
				return false;

			case 4:
				$this->_messages[] = 'No file selected.';
			
			default:
				$this->_messages[] = "System error uploading $filename. Contact webmaster.";
				return false;
		}
	}

	# Check Size
	protected function checkSize($filename, $size){
		if($size == 0){
			return false;
		}
		elseif($size > $this->_max){
			$this->_messages[] = "$filename exceeds maximum size: " . $this->getMaxSize();
			return false;
		}
		else{
			return true;
		}
	}

	# Check Type
	protected function checkType($filename, $type){
		if(empty($type)){
			return false;
		}

		elseif(!in_array($type, $this->_permitted)){
			$this->_messages[] = "$filename is not a permitted type of file.";
			return false;
		}

		else{
			return true;
		}
		
	}

	# Get maximum size
	protected function getMaxSize(){
		return number_format($this->_max / 1024, 1) . 'kB';
	}

	# Add permitted types
	public function addPermittedTypes($types){
		$types = (array) $types;
		$this->isValidMime($types);
		$this->_permitted = array_merge($this->_permitted, $types);
	}

	# Set permitted types
	public function setPermittedTypes($types){
		$types = (array) $types;
		$this->isValidMime($types);
		$this->_permitted = $types;
	}

	# Is Valid MIME
	protected function isValidMime($types){
		$alsoValid = array('image/tiff',
						   'application/pdf',
						   'text/plain',
						   'text/rtf');
		$valid = array_merge($this->_permitted, $alsoValid);
		foreach ($types as $type) {
			if(!in_array($type, $valid)){
				throw new Exception("$type is not a permitted MIME type");
			}
		}
	}

	# Set maximum filesize
	public function setMaxSize($num){
		if(!is_numeric($num)){
			throw new Exception("Maximum size must be a number");
		}
		$this->_max = (int) $num;
	}

	# Check name
	protected function checkName($name, $overwrite){
		$nospaces = str_replace(' ', '_', $name);
		if($nospaces != $name){
			$this->_renamed = true;
		}
		if(!$overwrite){
			$exisiting = scandir($this->_destination);
			if(in_array($nospaces, $exisiting)){
				$dot = strrpos($nospaces, '.');
				if($dot){
					$base = substr($nospaces, 0, $dot);
					$extension = substr($nospaces, $dot);
				}
				else{
					$base = $nospaces;
					$extension = '';
				}

				$i = 1;

				do {
					$nospaces = $base . '_' . $i++ . $extension;
				} while (in_array($nospaces, $exisiting));
				$this->_renamed = true;
			}
		}
		return $nospaces;
	}

}