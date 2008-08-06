<?php
/**
 * Praized template fragment: Merchant vote button
 *
 * @version 1.0.3
 * @package PraizedCommunity
 * @subpackage Templates
 * @author Stephane Daury
 * @copyright Praized Media, Inc. <http://praizedmedia.com/>
 * @license Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0>
 */
?>

<?php if ( pzdc_has_merchant() ) : ?>

<!-- begin vote button -->	     
    <?php if ( pzdc_merchant_vote_count(FALSE) > 0 ):  ?> 
    	<form action="<?php pzdc_merchant_permalink('votes'); ?>" class="praized-vote-button <?php pzdc_merchant_self_rating(); ?>" method="post">
    <?php else: ?>
    	<form action="<?php pzdc_merchant_permalink('votes'); ?>" class="praized-vote-button novotes" method="post">
    <?php endif;?>
    	<fieldset class="stats">
    		<legend><?php pzdc_e('Stats:'); ?></legend>
            <div class="score"><span class="positives"><?php pzdc_merchant_vote_pos_count(); ?></span><span class="separator">/</span><span class="total"><?php pzdc_merchant_vote_count(); ?></span></div>
        </fieldset>          
        <fieldset class="actions">
            <legend><?php pzdc_e('Actions:'); ?></legend>
            <?php if ( pzdc_is_authorized() ) :?>
                <button type="submit" title="<?php pzdc_e('Clicking here makes you vote UP!'); ?>"  class="vote-for vote-option login-required" name="vote" value="1"><b><?php pzdc_e('Vote Up'); ?></b></button>
                <button type="submit" title="<?php pzdc_e('Clicking here makes you vote DOWN!'); ?>"  class="vote-against vote-option login-required" name="vote" value="0"><b><?php pzdc_e('Vote Down'); ?></b></button>
            <?php else: ?>
                <button type="submit" title="<?php pzdc_e('You must login before you can vote! - Just click, we\'ll take you there and back!'); ?>"  class="vote-for vote-option login-required" name="vote" value="1"><b><?php pzdc_e('Vote Up'); ?></b></button>
                <button type="submit" title="<?php pzdc_e('You must login before you can vote! - Just click, we\'ll take you there and back!'); ?>"  class="vote-against vote-option login-required" name="vote" value="0"><b><?php pzdc_e('Vote Down'); ?></b></button>
            <?php endif;?>
        </fieldset>
	</form>
<!-- end vote button -->

<?php endif;?>
