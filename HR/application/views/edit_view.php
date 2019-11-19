<div class="create-body">
      <!-- <form action="/HR/update" method="post" enctype="multipart/form-data">
            <input class="input1" id="imageUpload" type="file" name="fileToUpload">
            <input type="hidden" name="id" value=<?php echo ($this->employeeId); ?>>
            <input class="input2" id="imageButton" type="submit" value="Upload Image" name="photo">
      </form> -->
     <!--  <form action="/HR/uploadpassport" method="post" enctype="multipart/form-data">
            <input class="input1" id="passportUpload" type="file" name="passportToUpload">
            <input class="input2" id="passportButton" type="submit" value="Upload Passport" name="passport">
      </form> -->
      <form action="/HR/update" method="post" enctype="multipart/form-data">

            <input class="input1" id="imageUpload" type="file" name="fileToUpload">
            <input type="hidden" name="id" value=<?php echo ($this->employeeId); ?>>
            <input class="input2" id="imageButton" type="submit" value="Upload Image" name="photo">

            <input class="input1" id="passportUpload" type="file" name="passportToUpload">
            <input class="input2" id="passportButton" type="submit" value="Upload Passport" name="passport">

            <input class="input1" id="diplomUpload" type="file" name="diplomToUpload">
            <input class="input2" id="diplomButton" type="submit" value="Upload Diplom" name="diplom">

            <div class="row">
                  <div class="col-md-3" style="top: 0">
                        <div id="personal-main" class="create-personal">
                              <div class="create-personal-header">Mitarbeiter</div>


                              <div class="personal-image">
                                    <?php if($this->employeeId!='') {
                                          if($this->employee->Photo!=''){?>
                                                <img src=<?php echo $this->employee->Photo; ?>
                                                onerror="this.onerror=null;this.src='images/user.png';">
                                          <?php }
                                          else{
                                          ?>
                                          <img src='images/user.png'>
                                          <?php }
                                          ?>
                                    <?php }
                                    else{
                                    ?>
                                          <img src='images/user.png'>
                                    <?php }
                                    ?>
                                    <label id="fileNameLabel" class="input-label-text">Foto auswählen</label>
                                    <div>
                                          <label for=""><?php echo $this->upload_err; ?></label>
                                    </div>

                                    <input type="hidden" name="Photo" value=<?php if($this->employeeId!= ''){echo $this->employee->Photo;}else{echo '';} ?>>

                                    <div class="input-buttons">
                                          <label class="input-label-select" for="imageUpload">Durchsuche</label>
                                          <label class="input-label-upload" for="imageButton">Hochladen</label>
                                    </div>
                              </div>

                              <div>
                                    <div class="bio-description">Name</div>
                                    <input type="hidden" name="id" value=<?php echo ($this->employeeId); ?>>
                                    <input type="text" name="Name" class="bio-value"
                                          value=<?php if($this->employeeId!= ''){echo $this->employee->Name;}else{echo '';} ?>>
                              </div>

                              <div>
                                    <div class="bio-description">Vorname</div>
                                    <input type="text" name="LastName" class="bio-value"
                                          value=<?php if($this->employeeId!= ''){echo $this->employee->LastName;}else{echo '';} ?>>
                              </div>

                              <div>
                                    <div class="bio-description">Arbeitsstatus</div>                                   
                                    <input list="WorkStatus" type="text" name="Status" class="bio-value" value="<?php if($this->employeeId!= ''){echo $this->employee->Status;}else{echo '';} ?>">
                                    <datalist id="WorkStatus">
                                          <option value="Arbeitet"></option>
                                          <option value="Ausgetreten"></option>
                                          <option value="Mutterschlafsurlaub"></option>
                                    </datalist>
                              </div>
                              <div>
                                    <div class="bio-description">Roles</div>
                                          <input list="Roles" name="Role" class="bio-value"
                                                value="<?php if($this->employeeId!= ''){      
                                                      echo $this->employee->Role; 
                                                }else{echo '';} 
                                                ?>">
                                                <datalist id="Roles">
                                                      <?php if (isset($this->roles[0])){
                                                            foreach($this->roles as $role){
                                                                  print '<option data-value=' . $role->idRole . '>' . $role->RoleTitle . '</option>';
                                                            }
                                                      } ?>
                                                </datalist>
                                          </div>
                              <input type="submit" id="btn-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                              <a id="btn-cancel" class="personal-categories-btn" href="/HR/main">Abbrechen</a>
                        </div>
                  </div>

                  <div id="personal-details" class="col-md-9">
                        <div id="personal-details-header" class="create-personal-header">Details</div>
                        <div class="row">
                              <div class="col-md-6">
                                    <div class="create-personal">
                                          <div class="create-personal-header">Personal</div>

                                          <div class="create-personal-content">
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="BirthDate" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->BirthDate;}else{echo '';} ?>>
                                          </div>
                                          <div> 
                                                <div class="bio-description">Zivilstand</div>
                                                <input list="CivilStand" name="CivilState" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->CivilState;}else{echo '';} ?>>
                                                <datalist id="CivilStand">
                                                      <option value="Ledig">
                                                      <option value="Verheiratet">
                                                      <option value="Geschieden">
                                                      <option value="Verwitwet">
                                                </datalist>

                                          </div>
                                          <div>                                                
                                                <div class="bio-description">Wohnadresse</div>
                                                <input type="text" name="Address" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Address;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">PLZ</div>
                                                <input type="text" name="PLZ" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->PLZ;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Ort</div>
                                                <input list="Cities" name="Place" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){      
                                                            echo $this->employee->Place; 
                                                      }else{echo '';} 
                                                      ?>">
                                                      <datalist id="Cities">
                                                            <?php if (isset($this->cities[0])){
                                                                  foreach($this->cities as $city){
                                                                        print '<option data-value=' . $city->idCity . '>' . $city->titleCity . '</option>';
                                                                  }
                                                            } ?>
                                                      </datalist>
                                          </div>
                                          <div>
                                                <div class="bio-description">Telefonnummer</div>
                                                <input type="tel" name="Phone" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Phone;}else{echo '';} ?>>
                                          </div>
                                    </div>
                                    <div class="create-personal-short">
                                          <div class="create-personal-header">Arbeit</div>
                                          <div>
                                               

                                                <div class="bio-description">Eintrittsdatum</div>
                                                <input type="date" name="CareerStart" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->StartDate;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Kommentar1</div>
                                                <input type="text" name="Comment1" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Comment1;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kommentar2</div>
                                                <input type="text" name="Comment2" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Comment2;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kommentar3</div>
                                                <input type="text" name="Comment3" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Comment3;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Position</div>
                                                <input type="text" name="Position" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Position;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Lohn</div>
                                                <input type="text" name="Salary" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Salary;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Productive</div>
                                                <input type="text" name="Productive" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->Productive;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Überstunden</div>
                                                <input type="text" name="OverTime" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->OverTime;}else{echo '';} ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">W.End</div>
                                                <input type="text" name="W_End" class="bio-value"
                                                      value="<?php if($this->employeeId!= ''){echo $this->employee->W_End;}else{echo '';} ?>">
                                          </div>











                                          <div class="passport-image">
                                                      <?php if($this->employeeId!='') {
                                                            if($this->employee->Diplom_Photo!=''){?>
                                                                  <img src="images/diplom.jpg"
                                                                  onerror="this.onerror=null;this.src='images/default-diplom.jpg';">
                                                            <?php }
                                                            else{
                                                            ?>
                                                            <img src="images/default-diplom.jpg">
                                                            <?php }
                                                            ?>
                                                      <?php }
                                                      else{
                                                      ?>
                                                            <img src="images/default-diplom.jpg">
                                                      <?php }
                                                      ?>
                                                      <?php if($this->employeeId!='') {
                                                            if($this->employee->Diplom_Photo!=''){?>
                                                            <div>
                                                                  <a href="<?php echo $this->employee->Diplom_Photo; ?>" target="_blank">Dokument öffnen</a>
                                                            </div>
                                                            <?php } ?>
                                                      <?php } ?>
                                                      <label id="diplomNameLabel" class="input-label-text">Foto auswählen</label>
                                                      <div>
                                                            <label for=""><?php echo $this->passport_upload_err; ?></label>
                                                      </div>

                                                      <input type="hidden" name="Diplom_Photo" value=<?php if($this->employeeId!='') {
                                                            if($this->employee->Diplom_Photo!=''){
                                                                  echo $this->employee->Diplom_Photo;
                                                            }
                                                      }
                                                      ?>>
                                                      <div class="input-buttons">
                                                            <label class="input-label-select2" for="diplomUpload">Durchsuche</label>
                                                            <label  class="input-label-upload2" for="diplomButton">Hochladen</label>
                                                      </div>
                                                </div>
                                    </div>

                                    

                                    
                                    
                              </div>
                              <div class="col-md-6">

                                    <div class="create-personal">
                                                <div class="create-personal-header">Reisepass</div>
                                                <div>
                                                      <div class="bio-description">Pass Name</div>
                                                      <input type="text" name="Pass_Name" class="bio-value"
                                                            value=<?php if($this->employeeId!= ''){echo $this->employee->Pass_Name;}else{echo '';} ?>>
                                                </div>
                                                <div>
                                                      <div class="bio-description">Pass Vorname</div>
                                                      <input type="text" name="Pass_LastName" class="bio-value"
                                                            value=<?php if($this->employeeId!= ''){echo $this->employee->Pass_LastName;}else{echo '';} ?>>
                                                </div>
                                                <div>
                                                      <div class="bio-description">Pass Nummer</div>
                                                      <input type="text" name="Pass_Number" class="bio-value"
                                                            value="<?php if($this->employeeId!= ''){echo $this->employee->Pass_Number;}else{echo '';} ?>">
                                                </div>
                                                <div>
                                                      <div class="bio-description">Gültigkeit:</div>
                                                      <input type="date" name="Pass_Expired" class="bio-value"
                                                            value="<?php if($this->employeeId!= ''){echo $this->employee->Pass_Expired;}else{echo '';} ?>">
                                                </div>

                                                <div class="passport-image">
                                                      <?php if($this->employeeId!='') {
                                                            if($this->employee->Pass_Photo!=''){?>
                                                                  <img src="images/passport.jpg"
                                                                  onerror="this.onerror=null;this.src='images/default-passport.jpg';">
                                                            <?php }
                                                            else{
                                                            ?>
                                                            <img src="images/default-passport.jpg">
                                                            <?php }
                                                            ?>
                                                      <?php }
                                                      else{
                                                      ?>
                                                            <img src="images/default-passport.jpg">
                                                      <?php }
                                                      ?>
                                                      <?php if($this->employeeId!='') {
                                                            if($this->employee->Pass_Photo!=''){?>
                                                            <div>
                                                                  <a href="<?php echo $this->employee->Pass_Photo; ?>" target="_blank">Dokument öffnen</a>
                                                            </div>
                                                            <?php } ?>
                                                      <?php } ?>
                                                      <label id="passportNameLabel" class="input-label-text">Foto auswählen</label>
                                                      <div>
                                                            <label for=""><?php echo $this->passport_upload_err; ?></label>
                                                      </div>

                                                      <input type="hidden" name="Pass_Photo" value=<?php if($this->employeeId!='') {
                                                            if($this->employee->Pass_Photo!=''){
                                                                  echo $this->employee->Pass_Photo;
                                                            }
                                                      }
                                                      ?>>
                                                      <div class="input-buttons">
                                                            <label class="input-label-select2" for="passportUpload">Durchsuche</label>
                                                            <label  class="input-label-upload2" for="passportButton">Hochladen</label>
                                                      </div>
                                                </div>
                                    </div>
                       

                                    <div class="create-personal-short">
                                          <div class="create-personal-header">G17</div>
                                          <div>
                                                <div class="bio-description">G17 E-Mail</div>
                                                <input type="mail" name="G17_email" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->G17_email;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">G17 Kürzel</div>
                                                <input type="text" name="G17_initials" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->G17_initials;}else{echo '';} ?>>
                                          </div>
                                    </div>
                              
                                    <div class="create-personal-short">
                                          <div class="create-personal-header">HHM</div>
                                          <div>
                                                <div class="bio-description">HHM E-Mail</div>
                                                <input type="text" name="HHM_email" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->HHM_email;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">HHM Kürzel</div>
                                                <input type="text" name="HHM_initials" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->HHM_initials;}else{echo '';} ?>>
                                          </div>
                                    </div>
                              </div>
                                          
                        </div>
                      

                        <hr>
                        <div class="row">
                              <div class="col-md-6">
                              <div id="childPlaceholder"> 
                                    <?php $childCounter = 0?>
                                    <?php if ($this->employeeId!= '') : ?>
                                    <?php if (isset($this->employee->Children[0])) : ?>
                                    <?php foreach($this->employee->Children as $child):?>
                                    <?php $childCounter++?>
                                    <div class="create-personal-short">
                                          <div class="create-personal-header"><div style="margin-bottom:15px; display:inline-block">
                                          Kinder</div>
                                          <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteVisit(this)" style="height:30px; line-height:10px; margin-top:5px; margin-right:15px; display:inline-block; float:right">Entfernen</button>
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>

                                                <input type="text" name=<?php print htmlentities("child[ChildName_".$childCounter."]")?> class="bio-value"
                                                      value=<?php echo $child->ChildName; ?>>
                                          </div>
                                          <div>
                                          <div class="bio-description">Kinder Vorname</div>
                                                <input type="text" name=<?php print htmlentities("child[ChildLastName_".$childCounter."]")?> class="bio-value"
                                                      value=<?php echo $child->ChildLastName; ?>>
                                          </div>
                                          <div>
                                          <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name=<?php print htmlentities("child[ChildBirthday_".$childCounter."]")?> class="bio-value"
                                                      value="<?php echo $child->ChildBirthday; ?>">
                                          </div>
                                    </div>
                                    <?php endforeach?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                              </div>












                                    <!-- <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName1" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[0]->ChildName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorname</div>
                                                <input type="text" name="ChildLastName1" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[0]->ChildLastName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday1" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[0]->ChildBirthday;}else{echo '';} ?>>
                                          </div>

                                    </div>
                                    <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName2" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[1]->ChildName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorame</div>
                                                <input type="text" name="ChildLastName2" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[1]->ChildLastName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday2" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[1]->ChildBirthday;}else{echo '';} ?>>
                                          </div>
                                    </div>
                                    <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName3" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[2]->ChildName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorame</div>
                                                <input type="text" name="ChildLastName3" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[2]->ChildLastName;}else{echo '';} ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday3" class="bio-value"
                                                      value=<?php if($this->employeeId!= ''){echo $this->employee->Children[2]->ChildBirthday;}else{echo '';} ?>>
                                          </div>
                                    </div> -->


                                    <button id="btnAddChild" type="button" class="btn btn-success">Baby hinzufügen</button>
                              </div>

                              <div class="col-md-6">
                              <div id="visitPlaceholder"> 
                                    <?php $visitCounter = 0?>
                                    <?php if ($this->employeeId!= '') : ?>
                                    <?php if (isset($this->employee->SwissVisit[0])) : ?>
                                    <?php foreach($this->employee->SwissVisit as $visit):?>
                                    <?php $visitCounter++?>
                                    <div class="create-personal-short">
                                          <div class="create-personal-header"><div style="margin-bottom:15px; display:inline-block">
                                          Schweiz-Aufenthalte</div>
                                          <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteVisit(this)" style="height:30px; line-height:10px; margin-top:5px; margin-right:15px; display:inline-block; float:right">Entfernen</button>
                                          </div>
                                          <div>
                                                <div class="bio-description">Reisebeginn</div>

                                                <input type="date" name=<?php print htmlentities("visit[VisitStart_".$visitCounter."]")?> class="bio-value"
                                                      value=<?php echo $visit->StartDate; ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Reiseende</div>
                                                <input type="date" name=<?php print htmlentities("visit[VisitEnd_".$visitCounter."]")?> class="bio-value"
                                                      value=<?php echo $visit->EndDate; ?>>
                                          </div>
                                          <div>
                                                <div class="bio-description">Standort</div>
                                                <input type="text" name=<?php print htmlentities("visit[VisitLocation_".$visitCounter."]")?> class="bio-value"
                                                      value="<?php echo $visit->Location; ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Unterkunft</div>
                                                <input type="text" name=<?php print htmlentities("visit[VisitAccommodation_".$visitCounter."]")?> class="bio-value"
                                                      value="<?php echo $visit->Accommodation ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Ziel</div>
                                                <input type="text" name=<?php print htmlentities("visit[VisitGoal_".$visitCounter."]")?> class="bio-value"
                                                      value="<?php echo $visit->Goal ?>">
                                          </div>
                                          <div>
                                                <div class="bio-description">Gruppe</div>
                                                <input type="text" name=<?php print htmlentities("visit[VisitGroup".$visitCounter."]")?> class="bio-value"
                                                      value="<?php echo $visit->Group ?>">
                                          </div>
                                    </div>
                                    <?php endforeach?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                              </div>
                              <button id="btnAddVisit" type="button" class="btn btn-success">Neues Reisen</button>
                              
                              </div>
                        </div>
                  </div>
            </div>
      </form>
</div>

<div id="visitTemplate" class="create-personal-short collapse">
      <div class="create-personal-header">Schweiz-Aufenthalte
            <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteVisit(this)" style="height:30px; line-height:10px; margin-top:5px; margin-right:15px; display:inline-block; float:right">Entfernen</button>
      </div>
      <div>
            <div class="bio-description">Reisebeginn</div>
            <input type="date" name="visit[VisitStart_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Reiseende</div>
            <input type="date" name="visit[VisitEnd_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Standort</div>
            <input type="text" name="visit[VisitLocation_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Unterkunft</div>
            <input type="text" name="visit[VisitAccommodation_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Ziel</div>
            <input type="text" name="visit[VisitGoal_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Gruppe</div>
            <input type="text" name="visit[VisitGroup_1]" class="bio-value">
      </div>
</div>
<div id="childTemplate" class="create-personal-child collapse">
      <div class="create-personal-header">Kinder
      <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteChild(this)" style="height:30px; line-height:10px; margin-top:5px; margin-right:15px; display:inline-block; float:right">Entfernen</button>
      </div>
      <div>
            <div class="bio-description">Kinder Name</div>
            <input type="text" name="child[ChildName_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Kinder Vorame</div>
            <input type="text" name="child[ChildLastName_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Geburtsdatum</div>
            <input type="date" name="child[ChildBirthday_1]" class="bio-value">
      </div>
</div>
<script src="js/empCreate.js"></script>
