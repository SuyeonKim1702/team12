var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new kakao.maps.LatLng(37.55708709545054, 126.94558145584872), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

//마커 좌표위치,좌석정보,남은좌석 수,카페 이름을 데이터베이스에서 받아와서 데이터 배열생성(push);
var listData=[
    {
        cafeName: '스타벅스', //받아 와야함
        latlng: new kakao.maps.LatLng(37.5584357,126.945926),   //위도경도
        seatStat: '보통',  //좌석상태
        seatNum : 10       //남은좌석수
    },
    {
        cafeName: '메가커피',
        latlng: new kakao.maps.LatLng(37.5578861,126.945949),
        seatStat: '만석',
        seatNum: 1
    }

    ];

console.log("시행됨");



for(var i = 0;i<listData.length;i++) {
    if(listData[i].seatStat == '만석'){
        var markerImage = new kakao.maps.MarkerImage('./images/marker_red.png', new kakao.maps.Size(37,37));
        var marker = new kakao.maps.Marker({
            map : map,
            image : markerImage,
            position: listData[i].latlng,
        });
        marker.setMap(map);
    }
    else if(listData[i].seatStat == '보통'){
        var markerImage = new kakao.maps.MarkerImage('./images/mark_yellow.png', new kakao.maps.Size(37,37));
        var marker = new kakao.maps.Marker({
            map : map,
            image : markerImage,
            position: listData[i].latlng,
        });
        marker.setMap(map);
    }
    else{
        var markerImage = new kakao.maps.MarkerImage('./images/mark_green.png', new kakao.maps.Size(37,37));
        var marker = new kakao.maps.Marker({
            map : map,
            image : markerImage,
            position: listData[i].latlng,
        });
        marker.setMap(map);
    }

    //윈도우 인포에 표시할 내용
    var content = '<div class="custom">'+listData[i].cafeName+
        '<div style="color:red; font-size:11px;text-align:center;padding-top:4px">'+' 남은 좌석 수:'+listData[i].seatNum+'</div></div>';

    var infowindow = new kakao.maps.InfoWindow({
        content: content
    });

    // 마커에 이벤트를 등록하는 함수 만들고 즉시 호출하여 클로저를 만듭니다
    (function(marker, infowindow) {
        // 마커에 mouseover 이벤트를 등록하고 마우스 오버 시 인포윈도우를 표시
        kakao.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map, marker);
        });

        // 마커에 mouseout 이벤트를 등록하고 마우스 아웃 시 인포윈도우를 닫습니다
        kakao.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
    })(marker, infowindow);




}







