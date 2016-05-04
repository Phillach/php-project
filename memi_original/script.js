
function selection(selItem)
    {
    document.frmProfil.selItem.value=selItem;
    document.frmProfil.submit();
    }
    
function confirmation(id)
{
    var x=confirm("Voulez-vous vraiment supprimer la demande?");
   if(x==1)
    location="?selItem=demande&action=supprimer&id="+id
}

        