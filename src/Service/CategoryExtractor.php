<?php


namespace App\Service;


class CategoryExtractor
{
    private $categories;

    public function __construct($categories)
    {

        $this->categories = $categories;
    }
    public function getAllCategories()
    {
        $allCategories = [];
        $tmp = [];
        foreach($this->categories as $category){
            $data = [];
            foreach($category['categories'] as $line){
                $data = explode('/', $line, 3);
            }
            $tmp = $data ?? ['other'];
            foreach($tmp as $item){
                $allCategories[] = $item;
            }
        }

        $allCategories = array_unique($allCategories);
        sort($allCategories);

        return $allCategories;

    }

    public function getMainCategories()
    {
        $allCategories = [];
        foreach($this->categories as $category)
        {
            $data = [];
            foreach($category['categories'] as $line){
                $data = explode('/', $line, 2);
            }
            $allCategories[] = $data[0] ?? ['other'];

        }
        $allCategories = array_unique($allCategories);
        sort($allCategories);

        return $allCategories;

    }

}
