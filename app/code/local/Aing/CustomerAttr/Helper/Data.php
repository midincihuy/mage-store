<?php
 
class Aing_CustomerAttr_Helper_Data extends Mage_Core_Helper_Abstract
{
 public function getCityOptions($region_id)
	{
		$region_id = trim($region_id);
        if (empty($region_id)) {
            return false;
        }
        
        $regionCode = Mage::getModel('directory/region')->load($region_id)->getCode();
		$citylist = Mage::getModel('city/city')->getCollection()
					->addFieldToFilter('region_code',$regionCode)
					->setOrder('city','ASC');
		/* group by city after alter table icube_country_region_city add Kecamatan */
		$citylist->getSelect()->group('city');
		
		$result = array();
		foreach($citylist as $city){
			$value = $this->escapeHtml(trim($city->getCity()));
            $result[$value] = $value;
			
		}
		return $result;

	}
	
	public function getKecamatanOptions($city)
	{
		$city = trim($city);
        if (empty($city)) {
            return false;
        }
        
        $kecamatan = Mage::getModel('city/city')->getCollection()
					->addFieldToFilter('city',$city)
					->setOrder('kecamatan','ASC');
		
		$result = array();
		foreach($kecamatan as $kec){
			$value = $this->escapeHtml(trim($kec->getKecamatan()));
            $result[$value] = $value;
			
		}
		return $result;

	}
}