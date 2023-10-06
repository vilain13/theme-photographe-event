<?php
//   Bloc image avec infos complementaires ( Titre/Taxonomie catégorie) lien vers la page du post  et envoi de la data ID pour ouverture de l'img dans la lightbox
   // Bloc utilisé dans la front-page et la single
    
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
                <?php echo get_the_term_list(get_the_ID(), 'categorie', '', ', '); ?>
            </span>
            <span class="rollover-fullscreen fa-solid fa-expand fa-2xl" data-lightbox-item-id="<?php echo get_the_ID(); ?>"></span>
           
            <a href="<?php the_permalink(); ?>" class="rollover-eye fa-solid fa-eye fa-2xl"></a>
        </div>
            <?php the_post_thumbnail(); ?>
                                    
    </article>

               
            

 