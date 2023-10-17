<?php

class SocialSharing_Shares_Model_SharesObject extends SocialSharing_Core_BaseModel {

	public function addObject($shareId, $code, $itemId) {
		global $wpdb;
		$wpdb->insert($wpdb->prefix.'supsystic_ss_shares_object', array(
				'share_id' => $shareId,
				'code' => $code,
				'item_id' => $itemId,
		));
		return true;
	}

	public function getObjectsListProjectPageShares($projectId, array $networksId, $itemCode, $itemId) {
		global $wpdb;
		$list = array();
		$networksIn = implode(',', $networksId);
		$networksIn = '('.$networksIn.')';
		$sql = $wpdb->prepare("SELECT network_id, COUNT(*) AS total_shares FROM {$wpdb->prefix}supsystic_ss_shares JOIN {$wpdb->prefix}supsystic_ss_shares_object ON share_id = id WHERE project_id = %d AND network_id IN %1s AND code = %s AND item_id = %d GROUP BY network_id ", array((int)$projectId, $networksIn, $itemCode, (int) $itemId));
		$dbresult = $wpdb->get_results($sql, ARRAY_A);
		if(count($networksId)) {
			foreach($networksId as $oneNwkId) {
				$list[$oneNwkId] = 0;
			}
		}
		if(is_array($dbresult) && count($dbresult)) {
			foreach ($dbresult as $item) {
				$list[$item['network_id']] = $item['total_shares'];
			}
		}
		return $list;
	}
   public function getGalleryResources($galleryId) {
		global $wpdb;
		return $wpdb->get_results("SELECT resource_id FROM {$wpdb->prefix}gg_galleries_resources WHERE " . $wpdb->prepare(" gallery_id = %d ", array($galleryId)), ARRAY_A);
	}
   public function getGalleryAttachments($resourceId) {
		global $wpdb;
 		return $wpdb->get_results("SELECT attachment_id FROM {$wpdb->prefix}gg_photos WHERE " . $wpdb->prepare(" id = %d ", array($resourceId)), ARRAY_A);
	}
}
