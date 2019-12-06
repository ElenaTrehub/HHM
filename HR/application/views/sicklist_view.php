<table class="table table-striped table-bordered table-light sick-table">

      <thead class="thead-dark">
            <tr class="vacationMonthHeader">
                  <th>Mitarbeiter</th>
                  <th>Zusammen</th>
                  <th>Januar</th>
                  <th>Februar</th>
                  <th>März</th>
                  <th>April</th>
                  <th>Mai</th>
                  <th>Juni</th>
                  <th>Juli</th>
                  <th>August</th>
                  <th>September</th>
                  <th>Oktober</th>
                  <th>November</th>
                  <th>Dezember</th>
            </tr>
      </thead>
      <tbody>

            <?php foreach ($this->list as $employee): ?>
            <tr class="sick">
                  <td class="employeeInfo">
                        <form action="/HR/sick" method="post">
                              <button class="employee-main" type="submit">
                                    <img class="employee-photo" src=<?php print htmlentities($employee->Photo);?>
                                          alt="">
                                    <div style="display:inline-block"><?php print htmlentities($employee->Name);?></div>
                                    <div style="display:inline-block"><?php print htmlentities($employee->LastName);?>
                                    </div>
                                    <input name="idEmployee" type="hidden"
                                          value=<?php print htmlentities($employee->ID);?>>
                              </button>

                        </form>
                  </td>
                  <td class="vacationMonthTotal"><?php print htmlentities($employee->Total);?></td>
                  <?php foreach ($employee->Duration as $duration): ?>
                  <td class="vacationMonth"><?php print htmlentities($duration);?></td>
                  <?php endforeach?>
            </tr>
            <?php endforeach;?>
      </tbody>
</table>

<script src="/HR/js/vacation.js"></script>