<?php
// Afficher  le bloc images avec infos complementaires  et lien vers post
   
                // Récupérer l'image mise en avant
    
    ?>  
    <article class="photo filtered-image">
        <div class="rollover-image rowling-image">
            <span class="rollover-titre">
                <?php
                if (!empty(the_title())) {
                        the_title(); 
                }
            
                ?>
            </span>
            <span class="rollover-category">
                <?php echo get_the_term_list(get_the_ID(), 'categorie', '', ', '); ?></p>
            </span>
            <span class="rollover-fullscreen fa-solid fa-expand fa-2xl"></span>
            <a href="<?php the_permalink(); ?>" class="rollover-eye fa-solid fa-eye fa-2xl"></a>
        </div>
            <?php the_post_thumbnail(); ?>
                                    
    </article>

               
            

 