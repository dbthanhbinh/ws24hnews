<footer class="footer-section">
    <div class="container">    
        <?php 
            $footer_col = get_theme_mod('footer_layout', '3c');
            $keyReplace = '3c';
            if($footer_col)
                $keyReplace = $footer_col;
            // $keyReplace = preg_replace('/[-]/', '', '3c');
            // print_r($footer_col);
            get_template_part( 'modules/footer/content', $keyReplace);
        ?>  
    </div>
</footer>