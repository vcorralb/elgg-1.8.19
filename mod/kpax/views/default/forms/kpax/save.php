<?php

// Aquest fitxer i tot el relacionat a ell s'hauria de dir newGame o d'alguna manera que quedi clar que
// serveix per donar d'alta un joc nou.


$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$category = elgg_extract('category', $vars, ''); //NOU
$dateCreation = elgg_extract('dateCreation', $vars, ''); //NOU
$skills = elgg_extract('skills', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$csr_file = elgg_extract('csr_file', $vars, '');
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
?>


<div>
    <label><?php echo elgg_echo('kPAX:game:name'); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>

<div>
    <label><?php echo elgg_echo('kPAX:game:description'); ?></label><br />
    <?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>

//NOU
<div>
    <label><?php echo elgg_echo('kPAX:game:category'); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'category', 'value' => $category)); ?>
</div>

<div>
    <label><?php echo elgg_echo('kPAX:game:dateCreation'); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'dateCreation', 'value' => $dateCreation)); ?>
</div>
//FI NOU

<div> 
    <label><?php echo elgg_echo('kPAX:game:platforms'); ?></label><br />
    <?php echo elgg_view('input/checkboxes', array('name' => "plataformes", //It'd be great to include the logos
                                                   'options' => array('web' => '1', 
                                                                      'android' => '2',
                                                                      'iOS' => '3',
                                                                      'Nintendo DS' => '4',
                                                                      'PSP' => '5',
                                                                      'Nintendo Wii' => '6',
                                                                      'XBox' => '7'))); ?>
</div>

<div>
    <label><?php echo elgg_echo('kPAX:game:skills'); ?></label><br />
    <?php echo elgg_view('input/tags', array('name' => 'skills', 'value' => $skills)); ?>
</div>

<div>
    <label><?php echo elgg_echo('kPAX:game:tags'); ?></label><br />
    <?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

<h3>Security</h3>

<p>In order to connect your game to kPAX, it is necessary to create a specific public/private key pair. 
It can be done using <A HREF=http://www.openssl.org/>openSSL</A>. You only need to run the command:
</p>

<p><code>openssl req -out requestUser.csr -new -newkey rsa:2048 -nodes -keyout private.key</code>
</p>

<!-- <p><code>openssl req -passout pass:abcdefg -subj "/C=US/ST=IL/L=Chicago/O=IBM Corporation/OU=IBM Software Group/CN=Rational Performance Tester CA/emailAddress=rpt@abc.ibm.com" -new > waipio.ca.cert.csr</p> -->

<p>
Once you have run it, you should have two text files: the private key (.pml), which is only for your eyes, and the
certificate request file (.csr), which you must include below. kPAX will create and store a certificate in your 
game's information sheet.
</p>

<div>
    <label><?php echo elgg_echo('kPAX:game:csr_file'); ?></label><br />
    <?php echo elgg_view('input/file', array('name' => 'csr_file', 'value' => $csr_file)); ?>
</div>

<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}

?>
<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('kPAX:game:send'))); ?>
</div>
