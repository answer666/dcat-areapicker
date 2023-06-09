<div class="{{$viewClass['form-group']}} {{ $class }}">
    @php(is_null($value) ? $value = array_fill_keys($column, '') : $value = array_combine($column, $value))
    <label for="{{$areaId}}" class="{{$viewClass['label']}} control-label">{!! $label !!}</label>

    <div class="{{$viewClass['field']}}" id="{{$areaId}}">
        @include('admin::form.error')

        <div class="clearfix">
            @if(isset($column[0]))
                <div class="china-area-dropdown">
                    <select name="{{$column[0]}}" id="{{$areaId}}-province" class="custom-select">
                        <option selected>省</option>
                        @foreach($provinces as $province)
                            @if($province->code == $value[$column[0]])
                                <option value="{{$province->code}}" selected>
                                    {{$province->name}}
                                </option>
                            @else
                                <option value="{{$province->code}}">{{$province->name}}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
            @endif
            @if(isset($column[1]))
                <div class="china-area-dropdown">
                    @if($value[$column[1]])
                        <select name="{{$column[1]}}" id="{{$areaId}}-city" class="custom-select">
                            @else
                                <select name="{{$column[1]}}" id="{{$areaId}}-city" class="custom-select" disabled>
                                    @endif
                                    <option selected>市</option>
                                    @if($value[$column[1]])
                                        @foreach($cities as $city)
                                            @if($city->code == $value[$column[1]])
                                                <option value="{{$city->code}}" selected>{{$city->name}}</option>
                                            @elseif($city->parent_code == $value[$column[0]])
                                                <option value="{{$city->code}}">{{$city->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                </div>
            @endif
            @if(isset($column[2]))
                <div class="china-area-dropdown">
                    @if($value[$column[2]])
                        <select name="{{$column[2]}}" id="{{$areaId}}-district" class="custom-select">
                            @else
                                <select name="{{$column[2]}}" id="{{$areaId}}-district" class="custom-select" disabled>
                                    @endif
                                    <option selected>区</option>
                                    @if($value[$column[2]])
                                        @foreach($districts as $district)
                                            @if($district->code == $value[$column[2]])
                                                <option value="{{$district->code}}"
                                                        selected>{{$district->name}}</option>
                                            @elseif($district->parent_code == $value[$column[1]])
                                                <option value="{{$district->code}}">{{$district->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                </div>
            @endif

            @if(isset($column[3]))
                <div class="china-area-dropdown">
                    @if($value[$column[3]])
                        <select name="{{$column[3]}}" id="{{$areaId}}-town" class="custom-select">
                            @else
                                <select name="{{$column[3]}}" id="{{$areaId}}-town" class="custom-select" disabled>
                                    @endif
                                    <option selected>镇</option>
                                    @if($value[$column[3]])
                                        @foreach($towns as $town)
                                            @if($town->code == $value[$column[3]])
                                                <option value="{{$town->code}}"
                                                        selected>{{$town->name}}</option>
                                            @elseif($town->parent_code == $value[$column[2]])
                                                <option value="{{$town->code}}">{{$town->parent_code}}} -- {{$town->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                </div>
            @endif

            @if(isset($column[4]))
                <div class="china-area-dropdown">
                    @if($value[$column[4]])
                        <select name="{{$column[4]}}" id="{{$areaId}}-village" class="custom-select">
                            @else
                                <select name="{{$column[4]}}" id="{{$areaId}}-village" class="custom-select" disabled>
                                    @endif
                                    <option selected>村</option>
                                    @if($value[$column[4]])
                                        @foreach($villages as $village)
                                            @if($village->code == $value[$column[3]])
                                                <option value="{{$village->code}}"
                                                        selected>{{$village->name}}</option>
                                            @elseif($village->parent_code == $value[$column[3]])
                                                <option value="{{$village->code}}">{{$village->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                </div>
            @endif

            @if($enableCoordinate)
                <div class="china-area-dropdown">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">经度</span>
                        </div>
                        <input id="{{$areaId}}-longitude" type="text" name="{{$longitudeColumn}}"
                               value="{{$value[$longitudeColumn] ?? ''}}" class="form-control"
                               aria-label="经度">
                    </div>
                </div>

                <div class="china-area-dropdown">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">纬度</span>
                        </div>
                        <input id="{{$areaId}}-latitude" type="text" name="{{$latitudeColumn}}"
                               value="{{$value[$latitudeColumn] ?? ''}}" class="form-control"
                               aria-label="纬度">
                    </div>
                </div>
            @endif
        </div>

        @if($enableDetail)
            <div class="input-group mt-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">详细</span>
                </div>
                <input id="{{$areaId}}-detail-input" type="text" class="form-control"
                       aria-label="Text input with dropdown button" name="{{$detailColumn}}"
                       value="{{$value[$detailColumn] ?? ''}}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">附近
                    </button>
                    <div class="dropdown-menu" id="{{$areaId}}-near-dropdown-menu">
                    </div>
                </div>
            </div>
        @endif

        @if(!$disableMap)
            <div class="clearfix mt-1" id="{{$areaId}}-map"></div>
        @endif

        @include('admin::form.help-block')
    </div>
</div>

<style>
    .china-area-dropdown, .china-area-input {
        display: inline-block;
    }

    .china-area-dropdown .dropdown-menu {
        max-height: 200px;
        overflow-y: scroll;
    }

    #{{$areaId}}-map {
        min-height: {{$height ?? 300}}px;
    }
</style>
<script>
    (function (w, $) {
        // TODO 需要优化代码
        $('select').select2({
            language: "zh-CN",
            width: 'auto',
        });
        class Distpicker {
            provinces = @json($provinces);
            cities = @json($cities);
            districts = @json($districts);
            towns = @json($towns);
            villages = @json($villages);
            currentCities = [];
            currentDistricts = [];
            lat = {{empty($value[$latitudeColumn]) ? 39.916527 : $value[$latitudeColumn]}};
            lng = {{empty($value[$longitudeColumn]) ? 116.397128 : $value[$longitudeColumn]}};
            areaProxy;

            constructor() {
                this.areaProxy = new Proxy({province: {}, city: {}, district: {}, town:{}, village:{}}, {
                    set(target, p, value, receiver) {
                        console.log('pppp', p, value)
                        switch (p) {
                            case 'province':
                                {{--$('#{{$areaId}}-province-dropdown').text(value.name);--}}
                                $('#{{$areaId}}-province').val(value.code)

                                $('#{{$areaId}}-city').val('')
                                $('#{{$areaId}}-district').val('')
                                $('#{{$areaId}}-city').attr('disabled', false)
                                $('#{{$areaId}}-district').attr('disabled', true)
                                break;
                            case 'city':
                                $('#{{$areaId}}-city').val(value.code)
                                break;
                            case 'district':
                                $('#{{$areaId}}-district').val(value.code)
                                break;
                            case 'town':
                                $('#{{$areaId}}-town').val(value.code)
                                break;
                            case 'village':
                                $('#{{$areaId}}-village').val(value.code)
                                break;
                        }
                        target[p] = value;

                        return true;
                    },
                    get(target, p, receiver) {
                        return target[p];
                    }
                })

                $('#{{$areaId}}-province').change(e => {
                    let code = $(e.currentTarget).val();

                    this.currentCities = this.cities.filter(city => city.parent_code == code)

                    this.areaProxy.province = this.provinces.find(item => item.code == code)

                    this.dropdownItem(this.currentCities, 'city')

                })

                $('#{{$areaId}}-city').change(e => {
                    let code = $(e.currentTarget).val();

                    this.currentDistricts = this.districts.filter(city => city.parent_code == code)

                    this.areaProxy.city = this.cities.find(item => item.code == code)

                    this.dropdownItem(this.currentDistricts, 'district')
                })

                $('#{{$areaId}}-district').change(e => {
                    let code = $(e.currentTarget).val();

                    this.currentDistricts = this.towns.filter(city => city.parent_code == code)

                    this.areaProxy.district = this.districts.find(item => item.code == code)

                    this.getLocation()

                    this.dropdownItem(this.currentDistricts, 'town')
                })

                $('#{{$areaId}}-town').change(e => {
                    let code = $(e.currentTarget).val();

                    this.currentDistricts = this.villages.filter(city => city.parent_code == code)

                    this.areaProxy.town = this.towns.find(item => item.code == code)

                    this.getLocation()

                    this.dropdownItem(this.currentDistricts, 'village')
                })

                $('#{{$areaId}}-village').change(e => {
                    let code = $(e.currentTarget).val();

                    this.areaProxy.village = this.villages.find(item => item.code == code)

                    // this.dropdownItem(this.currentDistricts, 'village')

                    this.getLocation()
                })
            }

            dropdownItem(areas, type,) {
                let parent = $(`#{{$areaId}}-${type}`);
                console.log('parent', parent)
                parent.empty();

                let def = document.createElement('option');
                def.innerText = {city: '市', district: '区', town: '镇', village: '村'}[type];
                def.setAttribute('selected', 'selected')
                parent.append(def)

                areas.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area.code
                    option.innerText = area.name;

                    parent.append(option)
                })

                if ('district' === type) {
                    $('#{{$areaId}}-district').attr('disabled', false)
                }

                if ('town' === type) {
                    $('#{{$areaId}}-town').attr('disabled', false)
                }

                if ('village' === type) {
                    $('#{{$areaId}}-village').attr('disabled', false)
                }
            }

            getLocation() {
                //
            }
        }

        class Map extends Distpicker {
            marker = false;
            map;
            geo;
            cityService;

            constructor() {
                super();

                this.map = new qq.maps.Map(document.querySelector('#{{$areaId}}-map'), {
                    center: new qq.maps.LatLng(this.lat, this.lng),
                    zoom: 12,
                })
                this.geo = new qq.maps.Geocoder();
                this.cityService = new qq.maps.CityService();

                this.addMarker(new qq.maps.LatLng(this.lat, this.lng))

                this.cityService.setComplete(res => {
                    this.map.setCenter(res.detail.latLng)

                    this.addMarker(res.detail.latLng)
                });

                @if(!isset($value[$longitudeColumn]) || !$value[$longitudeColumn])
                    this.cityService.searchLocalCity();
                @endif

                    this.geo.setComplete(poi => {
                    this.addMarker(poi.detail.location)

                    $('#{{$areaId}}-latitude').val(poi.detail.location.lat)
                    $('#{{$areaId}}-longitude').val(poi.detail.location.lng)

                    if (poi.detail.gps_type) {
                        this.map.setCenter(poi.detail.location)
                    } else {
                        let filterCities = this.cities.filter(item => item.name === poi.detail.addressComponents.city)

                        let province = this.provinces.find(item => item.name === poi.detail.addressComponents.province)


                        let filterDistricts = this.districts.filter(item => item.name === poi.detail.addressComponents.district)

                        if (filterCities.length < 1) {
                            filterCities = this.cities.filter(item => item.parent_code === province.code)
                        }

                        this.areaProxy.province = province;

                        this.dropdownItem(this.cities.filter(item => item.parent_code === province.code), 'city')

                        this.areaProxy.city = filterCities.find(item => item.parent_code === province.code);

                        let districts = this.districts.filter(item => item.parent_code === this.areaProxy.city.code);
                        if (districts.length > 0) {
                            this.dropdownItem(districts, 'district')
                            this.areaProxy.district = filterDistricts.find(item => item.parent_code === this.areaProxy.city.code);
                        }

                        let town = poi.detail.addressComponents.town;
                        let street = poi.detail.addressComponents.street;
                        let streetNumber = poi.detail.addressComponents.streetNumber;

                        $('#{{$areaId}}-detail-input').val(town + (streetNumber.length > 0 ? streetNumber : street))

                        let detail = $('#{{$areaId}}-near-dropdown-menu');
                        detail.empty();

                        poi.detail.nearPois.forEach(item => {
                            let separator = this.areaProxy.city.name;
                            if (districts.length > 0) {
                                separator = this.areaProxy.district.name;
                            }

                            let near = item.address.split(separator);

                            if (near[1]) {
                                let option = document.createElement('button')
                                option.setAttribute('type', 'button');
                                option.setAttribute('class', `dropdown-item near-item`);
                                option.innerText = near[1];
                                detail.append(option)
                            }
                        })

                        $('#{{$areaId}}-near-dropdown-menu .near-item').click(e => {
                            $('#{{$areaId}}-detail-input').val($(e.currentTarget).text())
                        })
                    }
                })

                qq.maps.event.addDomListener(this.map, 'click', event => {
                    this.geo.getAddress(event.latLng)
                })
            }

            addMarker(latLng) {
                if (false === this.marker) {
                    this.marker = new qq.maps.Marker({
                        map: this.map,
                        position: latLng,
                    })
                } else {
                    this.marker.setPosition(latLng)
                }
            }

            getLocation() {
                this.geo.getLocation([this.areaProxy.province.name, this.areaProxy.city.name, this.areaProxy.district.name,
                    this.areaProxy.town.name, this.areaProxy.village.name].join())
            }
        }

        (function (src) {
            let script = document.createElement('script')
            script.src = src

            w.{{$areaId}} = () => {
                new Map()
            }

            document.head.appendChild(script)

        })('https://map.qq.com/api/js?v=2.exp&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&callback={{$areaId}}');
    })(window, jQuery)
</script>
