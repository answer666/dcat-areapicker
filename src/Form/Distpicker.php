<?php

namespace Lengwang\Distpicker\Form;

use Dcat\Admin\Form\Field;
use Lengwang\Distpicker\Models\ChinaArea;

class Distpicker extends Field
{
    protected $view = 'answer.distpicker::index';

    protected $height = 300; // 地图高度

    protected $areaId = ''; // 模板id

    protected $disableMap = false; // 关闭地图

    protected $enableDetail = false; // 使用地址详细

    protected $enableCoordinate = false; // 使用坐标

    protected $detailColumn = ''; // 地址详细字段

    protected $longitudeColumn = ''; // 经度字段

    protected $latitudeColumn = ''; // 纬度字段
    /**
     * @var array
     */
    private $pickerOptions;

    public function __construct($column, $arguments = [])
    {
        if (!is_array($column))
            throw new \Exception('column must be an array');

        $provinces = ChinaArea::provinces();
        $cities = ChinaArea::cities();
        $districts = ChinaArea::districts();
        $towns = ChinaArea::towns();
        $villages = ChinaArea::villages();

        $this->areaId = 'id' . md5(implode('', $column));

        $this->addVariables(compact( 'provinces', 'cities', 'districts', 'towns', 'villages'));

        parent::__construct($column, $arguments);
    }

    public function coordinate(array $lngLat): Distpicker
    {
        $this->enableCoordinate = true;

        $this->column[] = $lngLat[0];
        $this->column[] = $lngLat[1];

        $this->longitudeColumn = $lngLat[0];
        $this->latitudeColumn = $lngLat[1];

        return $this;
    }

    public function detail(string $detail): Distpicker
    {
        $this->enableDetail = true;

        $this->column[] = $detail;

        $this->detailColumn = $detail;

        return $this;
    }

    public function height(int $height): Distpicker
    {
        $this->height = $height;

        return $this;
    }

    public function disableMap(bool $disable = true): Distpicker
    {
        $this->disableMap = $disable;

        return $this;
    }
    //
    // public function default(array $options): Distpicker
    // {
    //     $this->default = $options;
    //     return $this;
    // }

    public function defaultVariables(): array
    {
        return array_merge(parent::defaultVariables(), [
            'height' => $this->height,
            'areaId' => $this->areaId,
            'enableDetail' => $this->enableDetail,
            'detailColumn' => $this->detailColumn,
            'enableCoordinate' => $this->enableCoordinate,
            'longitudeColumn' => $this->longitudeColumn,
            'latitudeColumn' => $this->latitudeColumn,
            'disableMap' => $this->disableMap,
            'pickerOptions' => $this->pickerOptions ?? []
        ]);
    }
}
