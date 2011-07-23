<?


# 1: allow POST/GET from other domains by default (referer check)
# 0: clear POST/GET arrays
$config['security']['default_cross_domain_post']=0;
$config['security']['default_cross_domain_get']=1;

# if referer is one of these domains, post/get is allowed, even if the default is deny
$config['security']['allow_post_from_domains']=array('2checkout.com','paypal.com');
$config['security']['allow_get_from_domains']=array('2checkout.com','paypal.com');

?>
