<footer class="footer-section">
    <div class="container-fluid">    
        <?php 
            $footer_col = get_theme_mod('footer_layout', '3c');
            $keyReplace = preg_replace('/[-]/', '', $footer_col);
            get_template_part( 'modules/footer/content', $keyReplace);
        ?>  
    </div>
</footer>