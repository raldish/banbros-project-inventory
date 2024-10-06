<div class="modal fade" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">BANBROS PROPERTIES ADD FORM</h4>
      </div>
      <div class="modal-body">
        
      <form action="insert.php" method="post">
            <table width="100%" class="table border">
                <tr>
                    <td>Company Code<input type="text" name="company_code" placeholder="Company Code" required></td>
                </tr>
                <tr>
                    <td>Assigned To<input type="text" name="assigned_to" placeholder="Name of the assignee" required></td>
                </tr>
                <tr>
                    <td>
                    <label for="location_n">Location</label>
                    <select name="location_n">
                    <option value="#">Select Department</option>
                    <option value="accounting">Accounting</option>
                    <option value="marketing">Marketing</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Model Description<input type="text" name="model_description" placeholder="Model Description" required></td>
                </tr>
                <tr>
                    <td>Serial Number<input type="text" name="serial_number" placeholder="NXE*********" required></td>
                </tr>
                <!-- <tr>
                    <td><button type="submit" id="submit" class="submit" name="submit"><span class="fa fa-save"></span> SUBMIT</button></td>
                </tr> -->
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Add Items</button>
        </form>
      </di>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->