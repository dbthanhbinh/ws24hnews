<footer class="footer-section">
    <div class="container">    
        <?php 
            $footer_col = get_theme_mod('footer_layout', '3c');
            $keyReplace = preg_replace('/[-]/', '', '2-col-2');
            get_template_part( 'modules/footer/content', $keyReplace);
        ?>  
    </div>
</footer>