<fieldset id="buildyourform">
    @if($isEdit)
        <legend>Edit Your Skills</legend>

    @else
        <legend>Add Your Skills</legend>

    @endif

</fieldset>
<input type="button" value="Add a field" class="btn btn-info" id="add"/>


<script>

    var availableSkills = @json($availableSkills);
    var options = availableSkills.map(function (skill) {
        return `<option value="${skill.id}">${skill.skill_name}</option>`;
    });

    var userSkills = @json($userskills);


    $(document).ready(function () {
        $("#add").click(function () {
            addSkill();
        });

        userSkills.forEach(function (skill) {
            addSkill(skill.skill_id, skill.level);
        });

    });

    function addSkill(skill_id, level) {
        var lastField = $("#buildyourform div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"form-group row\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);

        var fName = $("<select name=\"skill[" + intId + "][id]\" class=\"form-control col-md-4\"> " +
            "<option> Select Your Skill </option>" +
            options +
            "</select>");

        if (skill_id) {
            fName.val(skill_id);
        }

        var fType = $("<select name=\"skill[" + intId + "][level]\" class=\"form-control col-md-4\">" +
            "<option value=\"1\">1</option>" +
            "<option value=\"2\">2</option>" +
            "<option value=\"3\">3</option>" +
            "<option value=\"4\">4</option>" +
            "<option value=\"5\">5</option>" +
            "</select>");

        if (level) {
            fType.val(level);
        }

        var removeButton = $("<input type=\"button\" class=\"btn btn-danger\" value=\"X\" />");
        removeButton.click(function () {
            $(this).parent().remove();
        });

        fieldWrapper.append(fName);
        fieldWrapper.append(fType);
        fieldWrapper.append(removeButton);
        $("#buildyourform").append(fieldWrapper);
    }

</script>