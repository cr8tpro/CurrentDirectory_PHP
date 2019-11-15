<?php
class Path
{
    public $current_path;

    function __construct($path)
    {
        $this->current_path = $path;
    }

    /*
    * implement current directory function
    * author : Bojan Stojanovic 11/15/2019
    * logic :
    * split parameter path with delimiter "/" and push values to array.
    * 1. if startswith "." skip to add to array
    * 2. if "..", pop last element from original path array to show parent dir path
    * 3. except above cases, add array element one by one to original path array
    * 4. concat array elements by "/" again and display
    */
    public function cd($new_path)
    {
        /* split the parameter path by delimiter "/" */
        $new_dirpaths = explode('/', $new_path);
     
        /* split the current pwd by delimiter "/" */
        $org_dirpaths = explode('/', $this->current_path);

        if (substr($new_path, 0, 1) === "/") {
            /* if $new_path starts with "/" navigate to root directory, so make $org_dirpaths as empty */
            $org_dirpaths = array();
        }

        foreach ($new_dirpaths as $new_dirpath) {
            /* indicates current directory, no need to display "." so continue */
            if ($new_dirpath === '.')
                continue;
            
            if ($new_dirpath === "..") {
                /* indicates parent directory so remove current folder path from array */
                array_pop($org_dirpaths);
            } else {
                /* navigate to new directory so add to-nav folder to array */
                array_push($org_dirpaths, $new_dirpath);
            }
        }

        /* concat all array elements with "/" to make realpath from array */
        echo implode('/', $org_dirpaths) . "\n";
    }
}

$path = new Path('/a/b/c/d');
$path->cd('../x');

$path->cd('./x');

$path->cd('x');

$path->cd('/a');

$path->cd('../../e/../f');

$path->cd('/d/e/../a');