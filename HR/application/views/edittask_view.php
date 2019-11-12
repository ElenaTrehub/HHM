<div class="create-body2">
    <form action="/HR/updatetask" method="post" enctype="multipart/form-data">
        <div id="personal-details" class="col-md-12">
            <div id="personal-details-header" class="create-personal-header">Task Details</div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" value=<?php echo ($this->taskId); ?>>
                    <div>                                                
                        <div class="bio-description">Task name</div>
                            <input type="text" name="Title" class="bio-value"
                                value=<?php if($this->taskId!= ''){echo $this->task->TaskTitle;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Task text</div>
                            <input type="text" name="Text" class="bio-value"
                                value=<?php if($this->taskId!= ''){echo $this->task->TaskText;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Task start</div>
                            <input type="date" name="StartDate" class="bio-value"
                                value=<?php if($this->taskId!= ''){echo $this->task->TaskStart;}else{echo '';} ?>>
                    </div>
                    <div>                                                
                        <div class="bio-description">Task end</div>
                            <input type="date" name="EndDate" class="bio-value"
                                value=<?php if($this->taskId!= ''){echo $this->task->TaskEnd;}else{echo '';} ?>>
                    </div>
                    <div>                       
                        <div class="bio-description">Darsteller</div>
                            <input list="Employees" name="Employee" class="bio-value"
                                value="<?php if($this->taskId!= ''){      
                                        echo $this->task->Employee; 
                                    }else{echo '';} 
                                    ?>">
                            <datalist id="Employees">
                                <?php if(isset($this->employees[0])){
                                    foreach($this->employees as $emp){
                                        print '<option data-value=' . $emp->id . '>' . $emp->Name . " ". $emp->LastName . " - ". $emp->Position . '</option>';
                                    }
                                } ?>
                            </datalist>
                    </div>
                    <div>                       
                        <div class="bio-description">Curator</div>
                            <input list="Curators" name="Curator" class="bio-value"
                                value="<?php if($this->taskId!= ''){      
                                        echo $this->task->Curator; 
                                    }else{echo '';} 
                                    ?>">
                            <datalist id="Curators">
                                <?php if(isset($this->employees[0])){
                                    foreach($this->employees as $emp){
                                        print '<option data-value=' . $emp->id . '>' . $emp->Name . " ". $emp->LastName . " -  ". $emp->Position . '</option>';
                                    }
                                } ?>
                            </datalist>
                    </div>
                    <div>
                        <div class="bio-description">Project</div>
                            <input list="Projects" name="Project" class="bio-value"
                                value="<?php if($this->taskId!= ''){      
                                    echo $this->task->Project;
                                }else{echo '';} 
                                ?>">
                                <datalist id="Projects">
                                    <?php if (isset($this->projects[0])){
                                        foreach($this->projects as $project){
                                                print "<option data-value='" . $project->IdProject . "'>" . $project->Number . "</option>";
                                        }
                                    } ?>
                                </datalist>
                    </div>
                    <div>                       
                        <div class="bio-description">Task status</div>
                            <input list="Statuses" name="Status" class="bio-value"
                                value="<?php if($this->taskId!= ''){      
                                        echo $this->task->StatusTask; 
                                    }else{echo '';} 
                                    ?>">
                            <datalist id="Statuses">
                                <?php if(isset($this->statuses[0])){
                                    foreach($this->statuses as $status){
                                        print '<option data-value=' . $status->idStatusTask . '>' . $status->statusTaskTitle .'</option>';
                                    }
                                } ?>
                            </datalist>
                    </div>
                    <div class="button-container">
                        <input type="submit" id="btn-project-add" name="SaveButton" class="personal-categories-btn" value="Speichern">
                              <a id="btn-project-cancel" class="personal-categories-btn" href="/HR/main">Abbrechen</a>
                              <input data-toggle="modal" value="Löschen" data-target="#bucketModalDelete" id="btn-project-delete" class="personal-categories-btn" >
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
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
            <form action="/HR/deletetask" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idTask" value=<?php print htmlentities($this->taskId); ?>>
                    <button type="submit" class="btn btn-danger">Ja</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                </div>
                <div class="modal-footer"></div>
            </form>
        </div>
    </div>
</div>

<script src="/HR/js/projectDeleteConfirm.js"></script>