<div class="create-body2">
    <div class="row">
        <div class="button-container col-md-12">
            <input data-toggle="modal" value="Projekt hinzufügen" data-target="#addModal" id="project-add" class="add-project-btn" >
            <div style="display: inline-block; width:200px;">
                <form action="/HR/editproject" method="post"> 
                    <input list="Projects" placeholder="Wählen Sie ein Projekt" name="numberProject" class="choose-project"
                        value="<?php if($this->projectId!= ''){      
                            echo $this->project->Number; 
                        }else{echo '';} 
                        ?>">
                        <datalist id="Projects">
                            <?php if(isset($this->projects[0])){
                                foreach($this->projects as $proj){
                                    print '<option type="submit"  value=' . $proj->project->Number . '>' . $proj->project->Number . '</option>';
                                }
                            } ?>
                        </datalist>
                </form>
            </div>
            
        </div>   
    </div>
    <?php if($this->projectId!= ''){?>
        <div class="row">
            <div class="col-md-12">
                <form action="/HR/updatetask" method="post" enctype="multipart/form-data">
                    <div id="personal-details" class="col-md-12">
                        <div id="personal-details-header" class="create-personal-header">Darsteller im Projekt</div>
                            <div class="row">                    
                                    <input list="Employees" placeholder="Wählen Sie einen Mitarbeiter" name="Employee" class="choose-employee">
                                        <datalist id="Employees">
                                            <?php if(isset($this->employees[0])){
                                                foreach($this->employees as $emp){
                                                    print '<option data-value=' . $emp->Id . '>' . $emp->Name . " ". $emp->LastName . " - ". $emp->Position . '</option>';
                                                }
                                            } ?>
                                        </datalist>
                                        <input style="line-height:40px;" type="submit" id="btn-employee-add" name="SaveButton" class="add-employee-btn" value="+">
                                </div>
                                  
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
</div>

        
    <?php } ?>
    

    <div class="col-md-12">
                <div id="personal-details" class="col-md-12">
                    <div id="personal-details-header" class="create-personal-header">Projekt ziele</div>
                        <div class="row">
                        </div>
                    </div>
            </div>


    
</div>

<div class="modal fade" id="bucketModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Drücken Sie Ja, um die Löschung zu bestätigen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/deleteproject" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idProject" value=<?php print htmlentities($this->projectId); ?>>
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Füllen Sie das Formular aus, um ein neues Projekt hinzuzufügen.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/HR/updateproject" method="post" enctype="multipart/form-data">
                <div id="personal-details" class="col-md-12">
                    <div id="personal-details-header" class="create-personal-header">Project Details</div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value=<?php echo ($this->projectId); ?>>
                            <div>                                                
                                <div class="bio-description">Name</div>
                                    <input type="text" name="Title" class="bio-value">
                            </div>
                            <div>                                                
                                <div class="bio-description">Number</div>
                                    <input type="text" name="Number" class="bio-value">
                            </div>
                            <div class="create-personal-content">
                                <div class="bio-description">Start</div>
                                    <input type="date" name="StartDate" class="bio-value">
                            </div>
                            <div class="create-personal-content">
                                <div class="bio-description">End</div>
                                    <input type="date" name="EndDate" class="bio-value">
                            </div>
                            <div>                                                
                                <div class="bio-description">Standort</div>
                                    <input type="text" name="Destination" class="bio-value">
                            </div>
                            <div>                                                
                                <div class="bio-description">Beschreibung</div>
                                    <input type="text" name="Description" class="bio-value">
                            </div>

                            
                            <div>                       
                                <div class="bio-description">Vorgesetzter</div>
                                    <input list="Curators" name="Curator" class="bio-value">
                                    <datalist id="Curators">
                                        <?php if(isset($this->curators[0])){
                                            foreach($this->curators as $cur){
                                                print '<option data-value=' . $cur->idCurator . '>' . $cur->Name . " ". $cur->LastName .'</option>';
                                            }
                                        } ?>
                                    </datalist>
                            </div>
                            
                            <div>
                                <div class="bio-description">Kunde</div>
                                    <input list="Clients" name="Client" class="bio-value">
                                        <datalist id="Clients">
                                            <?php if (isset($this->clients[0])){
                                                foreach($this->clients as $client){
                                                        print "<option data-value='" . $client->idClient . "'>" . $client->Title . "</option>";
                                                }
                                            } ?>
                                        </datalist>
                            </div>
                            <div>                       
                                <div class="bio-description">Project status</div>
                                    <input list="Statuses" name="Status" class="bio-value">
                                    <datalist id="Statuses">
                                        <?php if(isset($this->statuses[0])){
                                            foreach($this->statuses as $status){
                                                print '<option data-value=' . $status->idStatusProject . '>' . $status->statusProjectTitle .'</option>';
                                            }
                                        } ?>
                                    </datalist>
                            </div>
                            <div class="button-container">
                                <input type="submit" id="btn-project-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                                <a id="btn-project-cancel" class="personal-categories-btn" href="/HR/EditProject">Abbrechen</a>
                                <?php if($this->projectId!= ''){ ?>     
                                                <input data-toggle="modal" value="Löschen" data-target="#bucketModalDelete" id="btn-project-delete" class="personal-categories-btn" >
                                <?php } ?>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/HR/js/projectDeleteConfirm.js"></script>