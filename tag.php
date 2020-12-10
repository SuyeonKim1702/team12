<?php
    header("Content-type: text/css; charset: UTF-8");
    $seat_tag_color = "red";
?>
/* tag */

.cmd .btn_wrap .button{
  position: relative;
  left: 320px;
  /* z-index: 2; */
}

.tags {
  width: auto;
  height: 30px;
  font-family: 'Roboto', sans-serif;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #676A70;
  background-color: #E6E6E6;
  border: none;
  border-radius: 45px;
  /* box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); */
  /* transition: all 0.3s ease 0s; */
  /* cursor: pointer; */
  outline: none;
}
.info_tags .tags{
  margin-top: 10px;
}
.seat_info_tag {
  width: 80px;
  height: 30px;
  font-family: 'Roboto', sans-serif;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #ffffff;
  background-color: <?echo $seat_tag_color;?>;
  /* 배경색도 값에 따라 다르게 설정 */
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}
