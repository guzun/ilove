<?php
	if(!is_author()){
		get_template_part('author-box');
	}
    if(dynamic_sidebar ( 'main' ) ){
        
    }
?>