<?php
global $TFUSE;

if($TFUSE->request->isset_GET('tax_reviews') || $TFUSE->request->isset_GET('tax_games'))
    tf_get_search_sidebar('blue');
else
    tf_do_placeholder('blue');
