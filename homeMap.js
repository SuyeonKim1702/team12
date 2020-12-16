
var mapContainer = document.getElementById('map'), // 지도를 표시할 div
    mapOption = {
        center: new kakao.maps.LatLng(37.55708709545054, 126.94558145584872), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

//마커 좌표위치,좌석정보,남은좌석 수,카페 이름을 데이터베이스에서 받아와서 데이터 배열생성(push)

listData = [ {x: "37.5578", y: "126.946", cafeName: "모모커피", seat: "17"}
,{x: "37.5632", y: "126.943", cafeName: "커피플랜", seat: "11"}
, {x: "37.5564", y: "126.945", cafeName: "커핀그루나루 이대점", seat: "9"}
,{x: "37.5588", y: "126.945", cafeName: "빈스빈스 이대점", seat: "3"}
, {x: "37.5539", y: "126.938", cafeName: "아테네", seat: "17"}
, {x: "37.559", y: "126.946", cafeName: "팔공티 이화여대점", seat: "17"}
, {x: "37.5584", y: "126.946", cafeName: "레인트리", seat: "14"}
, {x: "37.5494", y: "126.95", cafeName: "비다펠리즈", seat: "1"}
, {x: "37.5559", y: "126.936", cafeName: "공차 현대신촌점", seat: "2"}
, {x: "37.5558", y: "126.938", cafeName: "카페시크릿", seat: "8"}
,{x: "37.5591", y: "126.938", cafeName: "엘피스", seat: "15"}
, {x: "37.5637", y: "126.934", cafeName: "이디야커피 연대서문점", seat: "1"}
, {x: "37.559", y: "126.946", cafeName: "공차 이대익스프레스점", seat: "1"}
, {x: "37.549", y: "126.939", cafeName: "마침내카페크로와플", seat: "5"}
, {x: "37.5593", y: "126.945", cafeName: "고스트요거트 이대점", seat: "17"}
, {x: "37.557", y: "126.936", cafeName: "타로카페썸", seat: "6"}
, {x: "37.5497", y: "126.937", cafeName: "보스턴커피", seat: "5"}
, {x: "37.5529", y: "126.937", cafeName: "베브릿지 서강대점", seat: "2"}
, {x: "37.5567", y: "126.937", cafeName: "신촌로스팅라이브러리", seat: "8"}
, {x: "37.5546", y: "126.936", cafeName: "커피더캠프", seat: "16"}
, {x: "37.5586", y: "126.942", cafeName: "카페게이트 가맹교육센터점", seat: "9"}
, {x: "37.5578", y: "126.946", cafeName: "롱커피 이대점", seat: "1"}
, {x: "37.5618", y: "126.936", cafeName: "마호가니 연세대학교점", seat: "13"}
, {x: "37.5592", y: "126.945", cafeName: "명동사주카페", seat: "9"}
,{x: "37.5579", y: "126.937", cafeName: "카페포엠", seat: "16"}
, {x: "37.5522", y: "126.939", cafeName: "투썸플레이스 서강대점", seat: "14"}
, {x: "37.5572", y: "126.946", cafeName: "카페쥬디", seat: "14"}
, {x: "37.5574", y: "126.942", cafeName: "참을성커피", seat: "1"}
, {x: "37.5563", y: "126.935", cafeName: "커피온리 신촌역점", seat: "20"}
, {x: "37.558", y: "126.946", cafeName: "프린세스다이어리", seat: "7"}
, {x: "37.558", y: "126.943", cafeName: "도나파스텔", seat: "15"}
, {x: "37.5579", y: "126.937", cafeName: "고양이다락방 신촌점", seat: "3"}
, {x: "37.5544", y: "126.935", cafeName: "곰미커피", seat: "15"}
, {x: "37.5583", y: "126.945", cafeName: "노뜨흐프헹땅", seat: "10"}
, {x: "37.5533", y: "126.934", cafeName: "커피스토리", seat: "19"}
, {x: "37.5554", y: "126.946", cafeName: "이디야커피 신촌그랑자이점", seat: "7"}
, {x: "37.5619", y: "126.947", cafeName: "날마다 이대점", seat: "20"}
, {x: "37.5588", y: "126.94", cafeName: "엠아이스위트", seat: "14"}
, {x: "37.5593", y: "126.944", cafeName: "파티션 WSC", seat: "19"}
, {x: "37.5579", y: "126.937", cafeName: "레인보우마카롱", seat: "17"}
, {x: "37.5641", y: "126.939", cafeName: "파스쿠찌 연세우리라운지점", seat: "7"}
, {x: "37.5492", y: "126.942", cafeName: "달쏘", seat: "16"}
, {x: "37.5584", y: "126.935", cafeName: "안다르커피", seat: "14"}
, {x: "37.5557", y: "126.936", cafeName: "신촌브루스", seat: "12"}
, {x: "37.5585", y: "126.935", cafeName: "아토", seat: "14"}
, {x: "37.5531", y: "126.937", cafeName: "팔공티 서강대점", seat: "15"}
,{x: "37.5588", y: "126.943", cafeName: "우주라이크카페 이대점", seat: "3"}
, {x: "37.5539", y: "126.939", cafeName: "더나더나", seat: "4"}
, {x: "37.5579", y: "126.946", cafeName: "메가커피 이대점", seat: "13"}
, {x: "37.5594", y: "126.945", cafeName: "앨리스", seat: "20"}
, {x: "37.5567", y: "126.937", cafeName: "카페낢진 신촌점", seat: "4"}
, {x: "37.5639", y: "126.934", cafeName: "아지트커피 연대서문점", seat: "5"}
, {x: "37.5584", y: "126.945", cafeName: "소원나무", seat: "11"}
, {x: "37.5577", y: "126.935", cafeName: "에프터눈티 신촌점", seat: "6"}
, {x: "37.5572", y: "126.951", cafeName: "카페GU12", seat: "1"}
, {x: "37.559", y: "126.935", cafeName: "카페언더우드", seat: "16"}
, {x: "37.5535", y: "126.946", cafeName: "콜링", seat: "9"}
, {x: "37.5637", y: "126.934", cafeName: "호이차 연대서문점", seat: "7"}
, {x: "37.5589", y: "126.943", cafeName: "오월에만난바나나", seat: "1"}
, {x: "37.5559", y: "126.936", cafeName: "뉴오리진 현대백화점 신촌점", seat: "20"}
, {x: "37.552", y: "126.937", cafeName: "커피랑도서관 서강대점", seat: "6"}
, {x: "37.5567", y: "126.937", cafeName: "멜로워 신촌더인피닛", seat: "6"}
, {x: "37.5488", y: "126.947", cafeName: "퍼넬스페셜티커피하우스", seat: "1"}
, {x: "37.5489", y: "126.938", cafeName: "호핀치", seat: "4"}
, {x: "37.5574", y: "126.935", cafeName: "퀘스트룸", seat: "8"}
, {x: "37.5565", y: "126.935", cafeName: "브이알지카페", seat: "16"}
, {x: "37.5565", y: "126.945", cafeName: "커피베이 이대역점", seat: "2"}
, {x: "37.5577", y: "126.943", cafeName: "서울엠티", seat: "20"}
, {x: "37.5574", y: "126.944", cafeName: "더착한커피 이대점", seat: "14"}
, {x: "37.5573", y: "126.938", cafeName: "콩", seat: "18"}
, {x: "37.5579", y: "126.939", cafeName: "화수목", seat: "19"}
, {x: "37.5623", y: "126.941", cafeName: "카페베네 연세의료원종합관점", seat: "8"}
, {x: "37.5581", y: "126.946", cafeName: "마시그래이 이대점", seat: "4"}
, {x: "37.5592", y: "126.945", cafeName: "커피온리 이대점", seat: "14"}
, {x: "37.5583", y: "126.943", cafeName: "나띵벗커피", seat: "3"}
, {x: "37.5563", y: "126.935", cafeName: "팔공티 신촌점", seat: "14"}
, {x: "37.5539", y: "126.938", cafeName: "산까치", seat: "17"}
, {x: "37.5564", y: "126.85", cafeName: "공차 서강대점", seat: "15"}
, {x: "37.5563", y: "126.944", cafeName: "운존", seat: "10"}
, {x: "37.5494", y: "126.938", cafeName: "에이스타", seat: "15"}
, {x: "37.558", y: "126.938", cafeName: "샤갈의눈내리는마을", seat: "3"}
, {x: "37.5232", y: "127.037", cafeName: "카페 필름포럼", seat: "7"}
, {x: "37.5494", y: "126.938", cafeName: "청자커피숍", seat: "15"}
, {x: "37.559", y: "126.946", cafeName: "조에", seat: "18"}
, {x: "37.5507", y: "126.936", cafeName: "리큐어커피바", seat: "17"}
, {x: "37.5619", y: "126.947", cafeName: "더벤티 이화여대포스코관점", seat: "4"}
, {x: "37.5547", y: "126.934", cafeName: "카페기웃기웃", seat: "14"}
, {x: "37.5492", y: "126.938", cafeName: "더크레딧", seat: "8"}
, {x: "37.5623", y: "126.941", cafeName: "파스쿠찌 연세심혈관병원점", seat: "16"}
, {x: "37.5586", y: "126.944", cafeName: "터치카페 이대점", seat: "20"}
, {x: "37.5582", y: "126.938", cafeName: "사주랑타로랑", seat: "5"}
, {x: "37.555", y: "126.936", cafeName: "쥬씨 신촌이마트점", seat: "6"}
, {x: "37.5578", y: "126.937", cafeName: "아이스베리 신촌점", seat: "18"}
, {x: "37.5595", y: "126.944", cafeName: "운이좋은아이", seat: "18"}
, {x: "37.5579", y: "126.94", cafeName: "카페 바람", seat: "1"}
, {x: "37.5573", y: "126.937", cafeName: "펀타임", seat: "5"}
, {x: "37.5623", y: "126.941", cafeName: "파스쿠찌 연세세브란스2호점", seat: "10"}
, {x: "37.5623", y: "126.941", cafeName: "업타운카페 신촌세브란스점", seat: "8"}
, {x: "37.5639", y: "126.942", cafeName: "카페베네 연세의료원ABMRC점", seat: "20"}
, {x: "37.5589", y: "126.939", cafeName: "한숨", seat: "12"}
]


console.log(listData);
for (var i = 0; i < listData.length; i++) {
    var position = new kakao.maps.LatLng(listData[i].x, listData[i].y);
    if (listData[i].seat < 4) {
        var markerImage = new kakao.maps.MarkerImage('./images/marker_red.png', new kakao.maps.Size(37, 37));
        var marker = new kakao.maps.Marker({
            map: map,
            image: markerImage,
            position: position
        });
        marker.setMap(map);

    } else if (listData[i].seat >= 4 && listData[i].seat <= 10) {

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
        '<div style="color:red; font-size:11px;text-align:left;padding-top:4px">' + ' 남은 좌석 수:' + listData[i].seat + '</div></div>';

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

