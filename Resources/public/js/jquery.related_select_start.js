$(function(){

      $("#related_select_form").relatedSelects({
      onChangeLoad: 'refreshData',
      loadingMessage: 'Please wait',
      defaultOptionText: ' -- Choose an option -- ',
      selects: ['OrganisationType[bussiness_unit_id]', 'OrganisationType[plant_id]', 'OrganisationType[division_id]','OrganisationType[department_id]','OrganisationType[area_id]','OrganisationType[equipment_id]']
      });
});

