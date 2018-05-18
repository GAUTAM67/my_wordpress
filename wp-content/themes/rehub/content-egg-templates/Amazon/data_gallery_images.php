<?php
/*
  Name: Images from Amazon
 */
use ContentEgg\application\helpers\TemplateHelper;  
?>

<?php $random_key = rand(0, 50);?>
<div class="justified-gallery rh-tilled-gallery five-thumbnails" data-galleryid="rhgal_<?php echo $random_key;?>">
    <?php wp_enqueue_script('justifygallery'); wp_enqueue_script('prettyphoto'); ?>
    <?php foreach ($items as $item): ?>
        <?php $offer_title = (!empty($item['title'])) ? $item['title'] : ''; ?> 
        <?php $gallery_images = (!empty ($item['extra']['imageSet'])) ? $item['extra']['imageSet'] : ''?>
                <?php if (!empty ($gallery_images)) :?>
                    
                    <?php
                        foreach ($gallery_images as $gallery_img) {
                            ?> 
                            <a href="<?php echo esc_attr($gallery_img['LargeImage']) ;?>" class="mb10" target="_blank"> 
                            <img src="<?php echo esc_attr($gallery_img['LargeImage']) ;?>" alt="<?php echo esc_attr($offer_title); ?>" height="160" />  
                            </a>
                            <?php
                        }
                    ?>
                    
                <?php endif ;?>      
    <?php endforeach; ?>
</div>
<div class="clearfix"></div>