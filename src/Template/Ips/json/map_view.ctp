<?php 
foreach ($ips as  &$ip) {
	unset($ip['user']['password']);
}
echo json_encode(compact('ips'));