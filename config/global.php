<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global config file
    |--------------------------------------------------------------------------
    |
    | This file is used for the end user to configure the blog the way he wants.
    |
    */
   

   //Blog title
   'title' => 'Blog',


   /*
   | Admins
   | - Grants permission to the admin panel
   | - Uses the database username of the specific user.
   |
   */
   'admins' => [
   				'NNS',
   			   ],



    /*
    | Design
    | - The user can decide between a few bootstrap designs to make his blog more unique. He can also add custom styles he 
    | - made himself
    | - Available Designs:
    | 	- cerulean
    |	- cosmo
    | 	- cyborg
    |	- darkly
    |	- flatly
    |	- journal
    |	- lumen
    |	- paper
    |	- readable
    |	- sandstone
    |	- simplex
    |	- slate
    |	- spacelab
    |	- superhero
    |	- united
    |	- yeti
    |	- default
    |	- custom (IF YOU SET THIS: SET THE WHOLE HYPERLINK TO THE CSS FILE IN THE 'custom' VARIABLE, OTHERWHISE THE CSS WILL BE BROKEN)
     */
    'design' => 'default',
    'custom' => 'Full Hyperlink to the CSS File here',


    /*
    | Registration
    | - Here you can close the registration or leave it open.
    | - Possible inputs: true, false
     */
    'registration' => true,




];


?>