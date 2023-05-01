<?php

$id = get('id', 10);
$utga = get('utga', 100);

try {
    _exec(
        "delete from transaction where id=? and create_user_id=?",
        'ii',
        [$id, $_SESSION['id']],
        $count
    );
    $_SESSION['messages'] = ["$utga utgatai guilgeeg amjilttai ustgalaa."];
} catch (Exception $e) {
    $_SESSION['error'] = ["$id-tei guilgeeg ustgaj chadsangui, Ta daraa dahin oroldono uu"];
} finally {
    if (isset($e)) {
        logError($e);
    }
}




redirect('/user/home');
