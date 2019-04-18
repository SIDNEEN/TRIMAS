<!-- Modal insert data -->
<div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มสถานประกอบการลงฐานข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  class="form-horizontal autoaddr"id="insertform" onsubmit="return false">
        <div class="modal-body">
          <!-- ชื่อสถานประกอบการ-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="companyName">ชื่อสถานประกอบการ</label>
            <div class="col-md-10 inputGroupContainer">
              <input id="companyName" name="companyName" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- ที่อยู่-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="companyAddress">ที่อยู่</label>
            <div class="col-md-10">
              <input id="companyAddress" name="companyAddress" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- ตำบล อำเภอ จังหวัด-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="companyTambol">ตำบล</label>
            <div class="col-md-4">
              <input id="companyTambol" name="district" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="companyAmpo">อำเภอ</label>
            <div class="col-md-4">
              <input id="companyAmpo" name="amphoe" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- รหัสไปรษณีย์-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="companyChangwat">จังหวัด</label>
            <div class="col-md-4">
              <input id="companyChangwat" name="province" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="companyZipCode">รหัสไปรษณีย์</label>
            <div class="col-md-4">
              <input id="companyZipCode" name="zipcode" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- เบอร์โทร-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="companyPhone">เบอร์โทร</label>
            <div class="col-md-10">
              <input id="companyPhone" name="companyPhonet" type="text" class="form-control" required="true">
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compPhone">Rating</label>
            <div class="col-md-10">
            <button type="button" class="btn btn-default btn-grey btn-sm rateButton fa fa-star-o" aria-label="Left Align">
						  
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton fa fa-star-o" aria-label="Left Align">
            
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton fa fa-star-o" aria-label="Left Align">
            
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton fa fa-star-o" aria-label="Left Align">
            
						</button>
						<button type="button" class="btn btn-default btn-grey btn-sm rateButton fa fa-star-o" aria-label="Left Align">
            
						</button>
            <div class="text-danger"><span id="alert-rating"></span></div>
            </div>
          </div>
          <!-- หมายเหตุ -->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compPhone">หมายเหตุ</label>
            <div class="col-md-10">
              <textarea class="form-control" name="note" id="note" cols="85" rows="3" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer" id="delconfirm">
          <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary submitCom" style="width:15%">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal viewdata -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลสถานประกอบการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th scope="row">ชื่อสถานประกอบการ</th>
              <td id="companyNameShow"></td>
            </tr>
            <tr>
              <th scope="row">ที่อยู่</th>
              <td id="companyAdrrShow"></td>
            </tr>
            <tr>
              <th scope="row">เบอร์โทร</th>
              <td id="companyPhoneShow"></td>
            </tr>
            <tr>
              <th scope="row">หมายเหตุ</th>
              <td id="noteShow"></td>
            </tr>
          </tbody>
        </table>
        <!-- <p><strong>ชื่อสถานประกอบการ :  </strong><span id="compName"></span></p>
      <p><strong>ที่อยู่ :  </strong><span id="companyAdrr"></span></p>
      <p><strong>เบอร์โทร : </strong><span id="companyPhone"></span></p> -->
      </div>
      <div class="modal-footer" id="delconfirm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal editdata -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลสถานประการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal autoaddr" action="upd_comp.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="companyID" id="compID">
          <input type="hidden" name="page" value="<?php echo $page;?>">
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compName">ชื่อสถานประกอบการ</label>
            <div class="col-md-10 inputGroupContainer">
              <input id="compName" name="companyName" type="text" class="form-control" required="true">
            </div>
          </div>

          <!-- ที่อยู่-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compAddress">ที่อยู่</label>
            <div class="col-md-10">
              <input id="compAddress" name="companyAddress" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- ตำบล อำเภอ จังหวัด-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compTambol">ตำบล</label>
            <div class="col-md-4">
              <input id="compTambol" name="district" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="compAmpo">อำเภอ</label>
            <div class="col-md-4">
              <input id="compAmpo" name="amphoe" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- รหัสไปรษณีย์-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compChangwat">จังหวัด</label>
            <div class="col-md-4">
              <input id="compChangwat" name="province" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="compZipCode">รหัสไปรษณีย์</label>
            <div class="col-md-4">
              <input id="compZipCode" name="zipcode" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- เบอร์โทร-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compPhone">เบอร์โทร</label>
            <div class="col-md-10">
              <input id="compPhone" name="companyPhonet" type="text" class="form-control" required="true">
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compPhone">คะแนน Rating</label>
            <div class="col-md-10"id="edit-rating">
            </div>
          </div>
          <input type="hidden" name="rating"id="rating">
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="compPhone">หมายเหตุ</label>
            <div class="col-md-10">
              <textarea class="form-control" name="note" id="compNote" cols="85" rows="3">สถานประกอบการนี้จัดการได้ดีเยี่ยม</textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer" id="delconfirm">

          <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary " style="width:15%">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Modalinserttobooking ICM-->
<div class="modal fade" id="modalListToBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">เลือกเปิดสถานประกอบการให้จอง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="ee"></span>
        <form class="was-validated">
        <table class="table" id="listComtobook">
        <thead>
              <tr>
                <th>ชื่อสถานประกอบการ</th>
                <th>จังหวัด</th>
                <th>Rating</th>
                <th style="width: 12%">จำนวน(คน)</th>
              </tr>
            </thead>
            <tbody id="tbd-com"></tbody>
        <?php
        // include('conn_mysql.php');
        
        // $sql="SELECT * FROM company
        // WHERE companyID NOT IN (SELECT companyID FROM booking WHERE majorID = 1 AND semesterID = $semesterID) ORDER BY rating DESC";
        // $result=mysqli_query($conn,$sql)or die("Query failed");
        // if(mysqli_num_rows($result)>0){
        //     while($row=mysqli_fetch_assoc($result)){
        //       $companyID = $row["companyID"];
        //       $rating=$row["rating"];
        //       echo '<tr id="'.$companyID.'">';
        //       echo '<td>
        //       <div class="custom-control custom-checkbox mb-3">
        //         <input type="checkbox" class="custom-control-input" id="companyID'.$companyID.'" required>
        //         <label class="custom-control-label" for="companyID'.$companyID.'">'.$row["companyName"].'</label>
        //         <div class="invalid-feedback">กรุณาติ้กถูกเพื่อเลือก</div>
        //       </div></td>';
        //       echo '<td>'.$row["companyChangwat"].'</td>';
        //       echo'<td><span style="display:none">'.$rating.'</span>';
        //             for ($i=0; $i < 5; $i++) { 
        //               if ($i<$rating) {
        //                 echo '<span class="text-warning"><i class="fa fa-star" aria-hidden="true"></i></span>';
        //               }else {
        //                 echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
        //               }
                      
        //             }
        //             echo'</td>';
        //       echo '<td><input class="form-control icmQuota" id="compaid-'.$companyID.'" name="icmQuota" type="number" value="2" required></td>';
        //       echo '</tr>';
        //   }
        // }else{
        //   echo"<tr><td>ไม่มีข้อมูล</td><td></td><td></td><td></td></tr>";
        // }
          ?>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <span id="btnsavetobooking"></span>
        
      </div>
    </div>
  </div>
</div>



<!-- modal edit booking -->
<div class="modal fade" id="bookingeditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลสถานประการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal autoaddr" action="upd_comp.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="companyID" id="bcompID">
          <input type="hidden" name="page" value="<?php echo $page;?>">
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompName">ชื่อสถานประกอบการ</label>
            <div class="col-md-10 inputGroupContainer">
              <input id="bcompName" name="companyName" type="text" class="form-control" required="true">
            </div>
          </div>

          <!-- ที่อยู่-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompAddress">ที่อยู่</label>
            <div class="col-md-10">
              <input id="bcompAddress" name="companyAddress" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- ตำบล อำเภอ จังหวัด-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompTambol">ตำบล</label>
            <div class="col-md-4">
              <input id="bcompTambol" name="district" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="bcompAmpo">อำเภอ</label>
            <div class="col-md-4">
              <input id="bcompAmpo" name="amphoe" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- รหัสไปรษณีย์-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompChangwat">จังหวัด</label>
            <div class="col-md-4">
              <input id="bcompChangwat" name="province" type="text" class="form-control" required="true">
            </div>
            <label class="col-md-2 col-form-label text-right" for="bcompZipCode">รหัสไปรษณีย์</label>
            <div class="col-md-4">
              <input id="bcompZipCode" name="zipcode" type="text" class="form-control" required="true">
            </div>
          </div>
          <!-- เบอร์โทร-->
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompPhone">เบอร์โทร</label>
            <div class="col-md-10">
              <input id="bcompPhone" name="companyPhonet" type="text" class="form-control" required="true">
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bedit-rating">คะแนน Rating</label>
            <div class="col-md-10"id="bedit-rating">
            </div>
          </div>
          <input type="hidden" name="rating"id="brating">
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="bcompNote">หมายเหตุ</label>
            <div class="col-md-10">
              <textarea class="form-control" name="note" id="bcompNote" cols="85" rows="3"></textarea>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label class="col-md-2 col-form-label" for="Quota">จำนวนคน</label>
            <div class="col-md-10 row">
              <label class="col-md-1 col-form-label" for="Quota" id="majorinfo"> </label>
              <input class="form-control col-md-2" id="Quota" name="Quota" type="number"  required>
            </div>
            
          </div>
        </div>

        <div class="modal-footer" id="delconfirm">

          <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit" style="width:15%">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal ดูผู้จอง --> <!-- ยกเลิกใช้ ใช้แบบ row detail แทน -->
<div class="modal fade" id="dataBooker" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลสถานประกอบการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="detail">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th scope="row">ชื่อสถานประกอบการ</th>
              <td id="companyNameBooker"></td>
            </tr>
            <tr>
              <th scope="row">นักศึกษาที่จอง</th>
              <td id="stdNameBooker"></td>
            </tr>
            
          </tbody>
        </table>
        <!-- <p><strong>ชื่อสถานประกอบการ :  </strong><span id="compName"></span></p>
      <p><strong>ที่อยู่ :  </strong><span id="companyAdrr"></span></p>
      <p><strong>เบอร์โทร : </strong><span id="companyPhone"></span></p> -->
      </div>
      <div class="modal-footer" id="delconfirm">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- ตรวจสอบ การซ้ำกัน -->
<div class="modal" id="showCompanyChecked" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ตรวจสอบสถานประกอบการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body checkCom" id="result">
            <p>กรุณาตรวจสอบข้อมูลสถานประกอบว่าซ้ำกับที่มีอยู่หรือไม่</p>
                <div class="row">
                  <table class="table table-bordered">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อสถานประกอบการ</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">เบอร์โทร</th>
                      </tr>
                    </thead>
                    <tbody id="list-company">
                    </tbody>
                  </table>

                  <br><br>
                  <div class="col text-center">
                    <div class="taxt-margin">
                      <b>ยืนยันการเพิ่มสถานประกอบการ ?</b>
                    </div>
                    <button type="button" class="btn btn-success btnaddit">ยืนยัน</button>
                    <button type="button" class="btn btn-danger btndontaddit" data-dismiss="modal">ยกเลิก</button>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>