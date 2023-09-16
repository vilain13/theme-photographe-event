

<!-- The Modal -->

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    
  <P class="close-cross">X</p>
    <img class="imgModale" src=" <?php echo get_template_directory_uri() . '/assets/contactheader.png'; ?>"  alt="image titre formulaire contact">
    
    <?php echo do_shortcode('[fluentform id="1"]'); ?> 
</div>