<?php
/**
 * Created by PhpStorm.
 * User: Irfan Rajput
 * Date: 7/10/2020
 * Time: 10:54 PM
 */

class Post_model extends CI_model
{
    function __construct()
    {
        parent::__construct();


    }

    function getPosts($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("posts p");
        $this->db->join('categories AS c', 'p.CATEGORY_ID = c.CATEGORY_ID');

        if($active==1){
            $this->db->where('p.ACTIVE',$active);
        }
        $this->db->order_by('p.POST_ID DESC');
        if($limit>0){
            $this->db->limit($limit);
        }
        $posts = $this->db->get()->result_array();

        return $posts;

    }

    function getPostById($post_id,$active=1){

        $this->db->select("*");
        $this->db->from("posts p");
        $this->db->join('categories AS c', 'p.CATEGORY_ID = c.CATEGORY_ID');


        if($active==1){
            $this->db->where('p.ACTIVE',$active);
        }
        $this->db->where('p.POST_ID ',$post_id);

        $posts = $this->db->get()->row_array();

        return $posts;

    }

    function addOrUpdatePost($form_array){
        if($form_array['POST_ID']){
            $this->db->where('POST_ID',$form_array['POST_ID']);
            return $this->db->update('posts',$form_array);

        }else{
            unset($form_array['POST_ID']);
            return $this->db->insert('posts', $form_array);
        }



    }


    function getCategories($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("categories c");
        if($active==1){
            $this->db->where('c.ACTIVE',$active);
        }

        if($limit>0){
            $this->db->limit($limit);
        }
        $categories = $this->db->get()->result_array();

        return $categories;

    }

    function getCategoryById($id){
        $this->db->where('CATEGORY_ID',$id);

        $category = $this->db->get('categories')->row_array();
        return $category;

    }

    function addOrUpdateCategory($form_array){
        if($form_array['CATEGORY_ID']){
            $this->db->where('CATEGORY_ID',$form_array['CATEGORY_ID']);
            return $this->db->update('categories',$form_array);

        }else{
            unset($form_array['CATEGORY_ID']);
            return $this->db->insert('categories', $form_array);
        }
    }
    
    function getYoutubePosts($limit=0,$active=1){

        $this->db->select("*");
        $this->db->from("youtube_posts p");
        $this->db->join('categories AS c', 'p.CATEGORY_ID = c.CATEGORY_ID');

        if($active==1){
            $this->db->where('p.ACTIVE',$active);
        }
        $this->db->order_by('p.POST_ID DESC');
        if($limit>0){
            $this->db->limit($limit);
        }
        $posts = $this->db->get()->result_array();

        return $posts;

    }

    function getYoutubePostById($post_id,$active=1){

        $this->db->select("*");
        $this->db->from("youtube_posts p");
        $this->db->join('categories AS c', 'p.CATEGORY_ID = c.CATEGORY_ID');


        if($active==1){
            $this->db->where('p.ACTIVE',$active);
        }
        $this->db->where('p.POST_ID ',$post_id);

        $posts = $this->db->get()->row_array();

        return $posts;

    }

    function addOrUpdateYoutubePost($form_array){
        if($form_array['POST_ID']){
            $this->db->where('POST_ID',$form_array['POST_ID']);
            return $this->db->update('youtube_posts',$form_array);

        }else{
            unset($form_array['POST_ID']);
            return $this->db->insert('youtube_posts', $form_array);
        }



    }


}