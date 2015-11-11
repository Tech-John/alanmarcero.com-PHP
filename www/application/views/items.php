<?php foreach ($items as $item) { ?>

    <h2><?php echo $item->name ?></h2>
    <img src="<?php echo "./" . $item->image_url ?>" class='styleRight' />
    <?php echo $item->content ?>

    <div class="clearLeft">
        <object type="application/x-shockwave-flash" data="/assets/dewplayer.swf?mp3=<?php echo $item->audio_demo ?>_lq.mp3" width="200" height="20">
        <param name="movie" value="/assets/dewplayer.swf?mp3=<?php echo $item->audio_demo ?>_lq.mp3" />
        </object><br />
        <a href="<?php echo $item->audio_demo ?>.mp3">Download Audio Demo</a>
    </div>

    <?php if ($item->for_sale) { ?>
        <form action = './addToCart' method = "POST">
            <div class="addToCart">
                <p style="margin:0px;">
                    $<input type="text" class="textField" name='price' value="25.00" size='5'/>
                    <input type='submit' value='Add To Cart' class='buttonSubmit' /><br />
                    <span class="priceNotice">Name your price (0.00 and up) -- 25.00 is suggested.  Price is in USD.</span>
                </p>
            </div>
            <input type="hidden" name="item_id" value="<?php echo $item->id ?>" />
        </form>
    <?php } else { ?>
        <form action = '<?php echo $item->full_item_url ?>' method = "GET">
            <div class="addToCart">
                <p style="margin:0px;">
                    $<input type="text" class="textField" name='price' value="0.00" size='5' disabled="true" />
                    <input type='submit' value='Download Now!' class='buttonSubmit' /><br />
                    <span class="priceNotice">This item is only available for free.</span>
                </p>
            </div>
        </form>
    <?php } ?>
    <hr />
<?php } ?>
