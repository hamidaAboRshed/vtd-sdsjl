<?php
class Enums extends CI_Model{
    const ProductMode  = array('Finished'=>2, 'Semi Finished'=>3,'SKD' => 1 );
    const AccessoryType = array('public' => 1, 'private' => 2,'driver'=>3);
    const OutputType = array('Fix' => 1, 'Flex' => 2);
    const AdjustableType = array('Not Adjustable' => 0,'Tilted' => 1, 'Rotated' => 2, 'Tilted & Rotated' => 3);
    const LEDColorTemperature = array(1=>'Tunable', 2 =>'NotTunable' ,3=>'RGB'   ,4 =>'RGBW' );
    const PowerMethod = array('Driver' => 1,'Power supply' => 2 );
    const DriverType = array('DOB' => 1,'Internal' => 2 ,'External' => 3,'Integrated' => 4);
    const BaseFixture = array('Socket' => 1,'Pin' => 2 ,'LED' => 3);
    const ProductPart = array('Fitting' => 1,'Driver' => 2, 'LED' => 3 , 'Accessory' => 4, 'Installation way Accessory' =>5 );
    const ProductType = array('Indoor' => 1,'Outdoor' => 2 );
    const ProductPowerType = array('Specific Drivers' => 1,'Without Drivers' => 2, 'AC' => 3 );
    const CCTRangeValues = array('Tunable White 3500-5000k' => -1,'RGB' => -2,'RGBW' => -3);
    const ProductFamilyType = array('Fitting with lighting source' => 1,'Just fitting without lighting source' => 2, 'Both' => 3 );
    const ACProductFunction = array('Bulb' => 1,'Normal Tube' => 2, 'Integrated Tube' => 3, 'Spotlight' => 4, "Other" =>5 );
    const LightingSourceType = array('LED' => 1 ,'Filement' => 2 );

    public function get_product_part()
    {
        return Enums::ProductPart;
    }

    public function get_LEDColorTemperature()
    {
        return Enums::LEDColorTemperature;   
    }

    public function get_BaseFixture(){
        return Enums::BaseFixture; 
    }

    public function get_LightingSourceType(){
        return Enums::LightingSourceType; 
    }

    public function get_ProductType(){
        return Enums::ProductType; 
    }

    public function get_PowerMethod()
    {
        return Enums::PowerMethod; 
    }

    public function get_DriverType()
    {
        return Enums::DriverType; 
    }

    public function get_DriverOutputType()
    {
        return Enums::OutputType;
    }

    public function get_ProductPowerType()
    {
        return Enums::ProductPowerType;
    }

    public function get_CCTRangeValues()
    {
        return Enums::CCTRangeValues;
    }
    
    public function get_ProductFamilyType()
    {
        return Enums::ProductFamilyType;
    }

    public function get_ACProductFunction()
    {
        return Enums::ACProductFunction;
    }

    public function get_CCTRangeValues_byId($id)
    {
        return array_search($id,Enums::CCTRangeValues) == FALSE ? null : array_search($id,Enums::CCTRangeValues);
    }
    
    public function get_PowerMethod_byId($id)
    {
        return array_search($id,Enums::PowerMethod) == FALSE ? null : array_search($id,Enums::PowerMethod);
    }

    public function get_DriverType_byId($id)
    {
        return array_search($id,Enums::DriverType) == FALSE ? null : array_search($id,Enums::DriverType);
    }

    public function get_AccessoryType_byId($id)
    {
        return array_search($id,Enums::AccessoryType) == FALSE ? null : array_search($id,Enums::AccessoryType);
    }

    public function get_BaseFixture_byId($id)
    {
        return array_search($id,Enums::BaseFixture) == FALSE ? null : array_search($id,Enums::BaseFixture);
    }
    public function get_AdjustableType_byId($id)
    {
        return array_search($id,Enums::AdjustableType) == FALSE ? null : array_search($id,Enums::AdjustableType);
    }

    public function get_DriverOutputType_byId($id)
    {
        return array_search($id,Enums::OutputType) == FALSE ? null : array_search($id,Enums::OutputType);
    }

    public function get_productMode()
    {
        return Enums::ProductMode;
    }

    public function get_AdjustableType()
    {
        return Enums::AdjustableType;
    }

    public function get_AccessoryType()
    {
        return Enums::AccessoryType;
    }
}
/*echo Enum::Day['Sunday'];
*/
/*class AccessoryType extends SplEnum
{
    const 
 		Fitting 	= 0
        , Driver    = 2
    ;
}

class OutputType extends SplEnum
{
    const 
 		Fix 	= 0
        , Flex  = 1
    ;
}

class Adjustable extends SplEnum
{
    const 
 		Tilted 	= 0
        , Rotated  = 1
    ;
}


class LEDColorTemperature extends SplEnum
{
    const 
 		Tunable 	  = 0
        , NotTunable  = 1
        , RGB 	      = 2

    ;
}

class DriverType extends SplEnum
{
    const 
 		External 	  = 0
        , Internal  = 1

    ;
}


class BaseFixture extends SplEnum
{
    const 
 		Socket 	  = 0
        , Pin  = 1
        , LED =2

    ;
}*/