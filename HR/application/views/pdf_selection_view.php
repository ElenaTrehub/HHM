<div class="row" style="background: $fdfdfd; padding-top:15px; width:100%">

      <div class="col-md-3 pdf-filters" style="display:inline-block; width:100%">
            <div class="pdf-parameter-card">
                  <div class="pdf-header">
                        Mitarbeiter
                  </div>
                  <div class="pdf-parameter-card-employee">
                        <?php foreach ($this->list as $employee) : ?>
                        <div class="pdf-selection-card">
                              <div class="pdf-checkbox">
                                    <input type="checkbox" name=<?php print htmlentities("Id[]" . $employee->Id) ?>
                                          value=<?php print htmlentities($employee->Id) ?> checked=true>
                              </div>
                              <div class="pdf-value">
                                    <?php print htmlentities($employee->Name . " " . $employee->LastName); ?>
                              </div>
                              <div style="display:inline-block; float:right; padding-right:10px; line-height:30px">
                                    <?php print htmlentities($employee->Id) ?>
                              </div>
                        </div>
                        <?php endforeach ?>
                  </div>


            </div>
            <div class="row" style="margin-right:0px; margin-bottom:15px;">
                  <div class="col-md-6">
                        <button class="btn btn-primary pdf-button" id="btn-select-employee" type="button">Alle
                              auswählen</button>
                  </div>
                  <div class="col-md-6">
                        <button class="btn btn-danger pdf-button" id="btn-unselect-employee" type="button">Alle
                              abwählen</button>
                  </div>
            </div>

            <div class="pdf-parameter-card">
                  <div class="pdf-header">
                        Datei
                  </div>
                  <div>
                  <div class="accordion">
                              <input id="accButton" type="checkbox" checked>
                              <i></i>
                              <div class="pdf-selection-card">
                                    <div class="pdf-checkbox">
                                         <input type="checkbox" name="MailData" value="1" checked=true>
                                    </div>
                                    <div class="pdf-value">
                                          E-Mail:  
                                    </div>
                              </div>
                              <div class="msg">
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="G17_mail" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                G17 E-Mail  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="G17_kurz" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                G17 Kürzel  
                                          </div>
                                    </div>
                                    
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="HHM_mail" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                HHM E-Mail  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="HHM_kurz" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                HHM Kürzel  
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="accordion">
                              <input id="accButton" type="checkbox" checked>
                              <i></i>
                              <div class="pdf-selection-card">
                                    <div class="pdf-checkbox">
                                         <input type="checkbox" name="PersonalData" value="1" checked=true>
                                    </div>
                                    <div class="pdf-value">
                                          Personalien  
                                    </div>
                              </div>
                              <div class="msg">
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Geburtsdatum" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Geburtsdatum  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Zivilstand" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Zivilstand  
                                          </div>
                                    </div>
                                    
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Wohnadresse" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Wohnadresse  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="PLZ" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                PLZ  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Ort" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Ort  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Telefon" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Telefon  
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="accordion">
                              <input id="accButton" type="checkbox" checked>
                              <i></i>      
                              <div class="pdf-selection-card">
                                    <div class="pdf-checkbox">
                                          <input type="checkbox" name="Career" value="1" checked=true>
                                    </div>
                                    <div class="pdf-value">
                                          Arbeit
                                    </div>
                              </div>
                              <div class="msg">
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Eintrittsdatum" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Eintrittsdatum  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Kommentar1" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Kommentar1  
                                          </div>
                                    </div>
                                    
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Kommentar2" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Kommentar2  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Kommentar3" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Kommentar3  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Position" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Position  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Lohn" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Lohn  
                                          </div>
                                    </div>
                              </div>




                        </div>
                        <div class="accordion">
                              <input id="accButton" type="checkbox" checked>
                              <i></i>
                              <div class="pdf-selection-card">
                                    <div class="pdf-checkbox">
                                          <input type="checkbox" name="ForeignPassport" value="1" checked=true>
                                    </div>
                                    <div class="pdf-value">
                                          Pass-Angaben
                                    </div>
                              </div>
                              <div class="msg">
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="PassName" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Pass Name  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="PassVorname" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Pass Vorname  
                                          </div>
                                    </div>
                                    
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Passnummer" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Passnummer  
                                          </div>
                                    </div>
                                    <div class="pdf-selection-card-include">
                                          <div class="pdf-checkbox">
                                                <input type="checkbox" name="Gültigkeit" value="1" checked=true>
                                          </div>
                                          <div class="pdf-value">
                                                Gültigkeit  
                                          </div>
                                    </div>
                                    
                              </div>


                        </div>
                        <div class="pdf-selection-card">
                              <div class="pdf-checkbox">
                                    <input type="checkbox" name="Children" value="1" checked=true>
                              </div>
                              <div class="pdf-value">
                                    Kinder
                              </div>
                        </div>

                        <div class="pdf-selection-card">
                              <div class="pdf-checkbox">
                                    <input type="checkbox" name="SwissVisit" value="1" checked=true>
                              </div>
                              <div class="pdf-value">
                                    Schweiz-Aufenthalte
                              </div>
                        </div>
                  </div>

            </div>

            <div class="row" style="margin-right:0px">
                  <div class="col-md-6">
                        <button class="btn btn-primary pdf-button" id="btn-select-categories">Alle
                              auswählen</button>
                  </div>
                  <div class="col-md-6">
                        <button class="btn btn-danger pdf-button" id="btn-unselect-categories">Alle
                              abwählen</button>
                  </div>
            </div>
            <div style="margin: 0px 15px;">
                  <button class="btn btn-success pdf-print" type="button" onclick="print()">Drucken</button>
            </div>
            <!--<input type="submit">-->
            </form>
      </div>

      <div class="col-md-9">
            <div class="pdf-header-preview">
                  Vorschau
            </div>
            <div class="pdf-preview-container">
                  <div class="pdf-preview">
                        <?php $counter = 1 ?>
                        <?php foreach ($this->list as $employee) : ?>
                        <div <?php if($counter == 1){?>style="border-top: 1px solid black;position: relative; height:auto"<?php }else{?>style="position: relative; height:auto"<?php }?> class="print-employee" id=<?php print htmlentities($employee->Id) ?>>
                              <div style="width: 20%;  display:inline-block; height:auto">
                                    <div style="text-align:center">
                                          <div>
                                                <img class="employee-photo"
                                                      style=" margin-top:15px; margin-left:auto; margin-right:auto; display: block" src=<?php echo $employee->Photo; ?>>           
                              
       
                                          </div>

                                          <?php print htmlentities($counter++ . ". " . $employee->Name . " " . $employee->LastName) ?><br><hr>
                                          <!-- <div style="text-align:center">
                                                <?php print htmlentities($employee->Position) ?>
                                          </div> -->
                                          <div class="col-md print-mail">
                                                <div class="col-md print-g17_mail">
                                                      <?php print htmlentities("G17 E-Mail:" . " " . $employee->G17_email) ?><br>
                                                </div> 
                                                <div class="col-md print-g17_kurz">   
                                                      <?php print htmlentities("G17 Kürzel:" . " " . $employee->G17_initials) ?><br><hr>
                                                </div>
                                                <div class="col-md print-hhm_mail">
                                                      <?php print htmlentities("HHM E-Mail:" . " " . $employee->HHM_email) ?><br>
                                                </div>
                                                <div class="col-md print-hhm_kurz">
                                                      <?php print htmlentities("HHM Kürzel:" . " " . $employee->HHM_initials) ?>
                                                </div>
                                          </div>
                                    </div>
                                    
                              </div>
<div style="width: 1px;  display:inline-block; height:100%; position: absolute; left: 20%; top: 0; background: #000;"></div>
                              <div class="cont" style="display:inline-block; vertical-align:top; width:79%">
                                    <div class="row pdf-print-data" style="width:100%">
                                          
                                          
                                          <div class="col-md print-personal el">
                                                <div class="col-md print-geburtsdatum">
                                                      Geburtsdatum:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->BirthDate))) ?>
                                                </div>
                                                <div class="col-md print-zivilstand">
                                                      Zivilstand:
                                                      <?php print htmlentities($employee->CivilState) ?>
                                                </div>
                                                <div class="col-md print-wohnadresse">
                                                      Wohnadresse: <?php print htmlentities($employee->Address) ?>
                                                </div>
                                                <div class="col-md print-PLZ">
                                                      PLZ: <?php print htmlentities($employee->PLZ) ?>
                                                </div>
                                                <div class="col-md print-ort">
                                                      Ort: <?php print htmlentities($employee->Place) ?>
                                                </div>
                                                <div class="col-md print-tell">
                                                      Telefon: <?php print htmlentities($employee->Phone) ?>
                                                </div>
                                          </div>
                                          <div class="col-md print-career el">
                                                Arbeit:
                                                <div class="col-md print-eintrittsdatum">
                                                      Eintrittsdatum:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->StartDate))) ?>
                                                </div>
                                                <div class="col-md print-comment1">
                                                      Kommentar1: <?php print htmlentities($employee->Comment1) ?>
                                                </div>
                                                <div class="col-md print-comment2">
                                                      Kommentar2: <?php print htmlentities($employee->Comment2) ?>
                                                </div>
                                                <div class="col-md print-comment3">
                                                      Kommentar3: <?php print htmlentities($employee->Comment3) ?>
                                                </div>
                                                <div class="col-md print-position">
                                                      Position: <?php print htmlentities($employee->Position) ?>
                                                </div>
                                                <div class="col-md print-lohn">
                                                      Lohn: <?php print htmlentities($employee->Salary) ?>
                                                </div>
                                          </div>
                                          <div class="col-md print-pass el">
                                                <div class="col-md print-pass_name">
                                                      Pass Name: <?php print htmlentities($employee->Pass_Name) ?>
                                                </div>
                                                <div class="col-md print-vorname">
                                                      Pass Vorname:
                                                      <?php print htmlentities($employee->Pass_LastName) ?>
                                                </div>
                                                <div class="col-md print-pass_nummer">
                                                      Passnummer:
                                                      <?php print htmlentities($employee->Pass_Number) ?>
                                                </div>
                                                <div class="col-md print-gultig">
                                                      Gültigkeit:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->Pass_Expired))) ?>
                                                </div>
                                          </div>
                                    </div>
                                          <div class="row print-children">
                                                Kinder:
                                                <table class="table table-sm table-stripped">
                                                      <thead>
                                                            <tr>
                                                                  <td>Name</td>
                                                                  <td>Vorname</td>
                                                                  <td>Geburtstag</td>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php foreach ($employee->Children as $child) : {
                                                                        if (isset($child->Name)) {;
                                                                        } ?>
                                                                        <tr>
                                                                              <td><?php print htmlentities($child->ChildName) ?></td>
                                                                              <td><?php print htmlentities($child->ChildLastName) ?></td>
                                                                              <td><?php print htmlentities(date("d.m.Y", strtotime($child->ChildBirthday))); ?></td>
                                                                        </tr>
                                                            <?php }
                                                      endforeach ?>
                                                      </tbody>
                                                </table>                                               

                                          </div>
                                          <div class="row print-visit">
                                                Schweiz-Aufenthalte:
                                                <table class="table table-sm table-stripped">
                                                      <thead>
                                                                        <tr>
                                                                              <td>Datum</td>
                                                                              <td>Standort</td>
                                                                              <td>Unterkunft</td>
                                                                              <td>Ziel</td>
                                                                              <td>Gruppe</td>
                                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php foreach ($employee->SwissVisit as $visit) :  ?>
                                                      <tr>
                                                            <td> <?php print htmlentities(date("d-m-Y", strtotime($visit->StartDate))); ?>
                                                            <?php print htmlentities(date("d-m-Y", strtotime($visit->EndDate))); ?></td>
                                                            <td><?php print htmlentities($visit->Location); ?></td>
                                                            <td><?php print htmlentities($visit->Accommodation); ?></td>
                                                            <td><?php print htmlentities($visit->Goal) ?></td>
                                                            <td><?php print htmlentities($visit->Group) ?></td>
                                                      </tr>
                                                      <?php endforeach; ?>

                                                      </tbody>
                                                </table>
                                          </div>
                                    
                              </div>
                        </div>
                        <?php endforeach ?>
                  </div>
            </div>
      </div>

</div>
<script src="/HR/js/print.js"></script>