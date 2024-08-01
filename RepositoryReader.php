<?php

class RepositoryReader
{
    private $codeDirectory;
    private $outputFile;
    private $fileContents;
    private $fileStructure;

    public function __construct($codeDirectory, $outputFile) {
        $this->codeDirectory = $codeDirectory;
        $this->outputFile = $outputFile;
        $this->fileContents = [];
        $this->fileStructure = ["Repository Information.", "This repository has the following structure:", "--------------------->"];
    }

    // Function to start the process
    public function processRepository() {
        $this->readDirectory($this->codeDirectory);
        $this->writeToFile();
        echo "All files have been read and written to {$this->outputFile}.\n";
    }

    // Recursive function to read files in a directory and generate file structure
    private function readDirectory($dir, $basePath = '', $level = 0) {
        $files = scandir($dir);
        $indent = str_repeat('    ', $level); // 4 spaces per level

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $dir . '/' . $file;
                $relativePath = ltrim($basePath . '/' . $file, '/');

                if (is_dir($filePath)) {
                    $this->fileStructure[] = $indent . 'DIR ' . $file;
                    $this->readDirectory($filePath, $relativePath, $level + 1);
                } else {
                    $this->fileStructure[] = $indent . 'DOC ' . $file;
                    $content = file_get_contents($filePath);
                    $this->fileContents[] = $this->formatFileContent($relativePath, $content);
                }
            }
        }
    }

    // Function to format the file content
    private function formatFileContent($fileName, $content) {
        return "=================>\n{$fileName}\n=================>\n{$content}\n=================>\n\n\n\n\n\n";
    }

    // Function to write all file contents to the output file
    private function writeToFile() {
        $finalContent = implode("\n", $this->fileStructure) . "\n\n\n\n\n\n" . implode("\n", $this->fileContents);
        file_put_contents($this->outputFile, $finalContent);
    }
}
