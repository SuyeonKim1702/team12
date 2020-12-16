
var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new kakao.maps.LatLng(37.55708709545054, 126.94558145584872), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다



console.log(listData);
for (var i = 0; i < listData.length; i++) {
    var position = new kakao.maps.LatLng(listData[i].x, listData[i].y);
    if (listData[i].seat <4) {
        var markerImage = new kakao.maps.MarkerImage('./images/marker_red.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);
        console.log("시행됨");
    } else if (listData[i].seat >=4 && listData[i].seat <= 10) {

        var markerImage = new kakao.maps.MarkerImage('./images/mark_yellow.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);
    } else {
        var markerImage = new kakao.maps.MarkerImage('./images/mark_green.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);
    }

    //윈도우 인포에 표시할 내용
    var content = '<div class="custom">' + listData[i].cafeName +
        '<div style="color:red; font-size:11px;text-align:center;padding-top:4px">' + ' 남은 좌석 수:' + listData[i].seat + '</div></div>';

    var infowindow = new kakao.maps.InfoWindow({
        content: content
    });

// 마커에 이벤트를 등록하는 함수 만들고 즉시 호출하여 클로저를 만듭니다
    (function (marker, infowindow) {
        // 마커에 mouseover 이벤트를 등록하고 마우스 오버 시 인포윈도우를 표시
        kakao.maps.event.addListener(marker, 'mouseover', function () {
            infowindow.open(map, marker);
        });

        // 마커에 mouseout 이벤트를 등록하고 마우스 아웃 시 인포윈도우를 닫습니다
        kakao.maps.event.addListener(marker, 'mouseout', function () {
            infowindow.close();
        });
    })(marker, infowindow);
}











