<?php
/**
 * @return string
 */

function get_url()
{
    return 'localhost:8000';
}

/**
 * @param string $folder
 * @param $image
 * @return string
 */
function getImageUrl(string $folder, $image)
{
    if ($image)
        return get_url() . '/images/' . $folder . '/' . $image;
    return get_url() . '/images/1.png';
}

/**
 * @param $folder
 * @param $file
 * @return string
 */
function saveImage($folder, $file)
{
    $image = $file;
    $input['image'] = mt_rand() . time() . '.' . $image->getClientOriginalExtension();
    $dist = public_path('/images/' . $folder . '/');
    $image->move($dist, $input['image']);
    return $input['image'];
}

/**
 * @param $folder
 * @param $file
 * @return int
 */
function deleteFile($folder,$file)
{
    $file = public_path('/images/'.$folder.'/'.$file);
    if(file_exists($file))
    {
        File::delete($file);
    }
    return 1;
}