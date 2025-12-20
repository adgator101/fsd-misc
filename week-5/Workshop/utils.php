<?php
/**
 * Custom Functions for Student Portfolio Manager
 */

/**
 * Format student name - Capitalize first letter of each word
 * @param string $name
 * @return string
 */
function formatName($name) {
    $name = trim($name);
    $name = ucwords(strtolower($name));
    return $name;
}

/**
 * Validate email address
 * @param string $email
 * @return bool
 */
function validateEmail($email) {
    $email = trim($email);
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Clean and process skills string
 * @param string $string
 * @return array
 */
function cleanSkills($string) {
    $string = trim($string);
    $skillsArray = explode(',', $string);
    $cleanedSkills = array_map(function($skill) {
        return trim($skill);
    }, $skillsArray);
    // Remove empty values
    $cleanedSkills = array_filter($cleanedSkills, function($skill) {
        return !empty($skill);
    });
    return array_values($cleanedSkills);
}

/**
 * Save student information to file
 * @param string $name
 * @param string $email
 * @param array $skillsArray
 * @return bool
 * @throws Exception
 */
function saveStudent($name, $email, $skillsArray) {
    $filename = 'students.txt';
    
    try {
        // Format the data
        $skillsString = implode(', ', $skillsArray);
        $data = $name . '|' . $email . '|' . $skillsString . PHP_EOL;
        
        // Open file in append mode
        $file = fopen($filename, 'a');
        
        if (!$file) {
            throw new Exception("Unable to open file: $filename");
        }
        
        // Write data to file
        $result = fwrite($file, $data);
        
        if ($result === false) {
            throw new Exception("Failed to write data to file");
        }
        
        fclose($file);
        return true;
        
    } catch (Exception $e) {
        throw new Exception("Error saving student: " . $e->getMessage());
    }
}

/**
 * Upload portfolio file with validation
 * @param array $file - $_FILES array element
 * @return string - Success message with filename
 * @throws Exception
 */
function uploadPortfolioFile($file) {
    $uploadDir = 'uploads/';
    $maxSize = 8 * 1024 * 1024; // 8MB in bytes
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    
    try {
        // Check for upload errors first
        if (!isset($file['error'])) {
            throw new Exception("No file was uploaded");
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize in php.ini',
                UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE in HTML form',
                UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
            ];
            $errorMsg = isset($errorMessages[$file['error']]) ? $errorMessages[$file['error']] : 'Unknown upload error';
            throw new Exception($errorMsg);
        }
        
        // Check if file was uploaded
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            throw new Exception("No temporary file found");
        }
        
        // Validate file size
        if ($file['size'] > $maxSize) {
            throw new Exception("File size exceeds 2MB limit");
        }
        
        // Validate file type
        $fileType = $file['type'];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only PDF, JPG, and PNG are allowed");
        }
        
        // Get file extension
        $originalName = basename($file['name']);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        
        // Validate extension
        if (!in_array($extension, $allowedExtensions)) {
            throw new Exception("Invalid file extension. Only PDF, JPG, and PNG are allowed");
        }
        
        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception("Failed to create upload directory");
            }
        }
        
        // Generate unique filename using string functions
        $timestamp = date('Ymd_His');
        $randomString = substr(md5(uniqid(rand(), true)), 0, 8);
        $newFilename = 'portfolio_' . $timestamp . '_' . $randomString . '.' . $extension;
        $targetPath = $uploadDir . $newFilename;
        
        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("Failed to move uploaded file");
        }
        
        return "File uploaded successfully: " . $newFilename;
        
    } catch (Exception $e) {
        throw new Exception("Upload error: " . $e->getMessage());
    }
}
?>
