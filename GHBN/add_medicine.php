<?php
// Doctor Schedule

$page_title = 'Add Medicine';
include('../Gincludes/header.php');
include('../Gincludes/mhead2.php');
include('../Gincludes/sidebar.php');
$error = array(
    "medicine_category" => "",
    "medicine_name" => "",
    "description" => "",
    "batch_number" => "",
    "quantity" => "",
    "price" => "",
    "manufacturer_name" => "",
    "manufactured_date" => "",
    "expired_date" => "",
    "note" => "",
    "discount" => "",
    "tax" => "",
	"top" => "",
	"success" => ""
);

if (isset($_POST['submit'])){ // Handle the form.

  $medicine_categoryArr = $_POST['medicine_category'];
  $medicine_nameArr = $_POST['medicine_name'];
  $descriptionArr = $_POST['description'];
  $batch_numberArr = $_POST['batch_number'];
  $quantityArr = $_POST['quantity'];
  $priceArr = $_POST['price'];
  $manufacturer_nameArr = $_POST['manufacturer_name'];
  $manufactured_dateArr = $_POST['manufactured_date'];
  $noteArr = $_POST['note'];
  $expired_dateArr = $_POST['expired_date'];
  $discountArr = $_POST['discount'];
  $taxArr = $_POST['tax'];
  if(!empty($medicine_nameArr)){
    for($i = 0; $i < count($medicine_nameArr); $i++){
      if(!empty($medicine_nameArr[$i])){
        $medicine_category = $medicine_categoryArr[$i];
        $medicine_name = $medicine_nameArr[$i];
        $description = $descriptionArr[$i];
        $batch_number = $batch_numberArr[$i];
        $quantity = $quantityArr[$i];
        $price = $priceArr[$i];
        $manufacturer_name = $manufacturer_nameArr[$i];
        $manufactured_date = $manufactured_dateArr[$i];
        $note = $noteArr[$i];
        $expired_date = $expired_dateArr[$i];
        $discount = $discountArr[$i];
        $tax = $taxArr[$i];

        $q = "INSERT INTO medicine (medicine_category, medicine_name, description, batch_number, quantity, price, manufacturer_name, manufactured_date, expired_date, note, discount, tax) VALUES ('$medicine_categoryArr[$i]', '$medicine_nameArr[$i]', '$descriptionArr[$i]', '$batch_numberArr[$i]', '$quantityArr[$i]', '$priceArr[$i]', '$manufacturer_nameArr[$i]', '$manufactured_dateArr[$i]', '$expired_dateArr[$i]', '$noteArr[$i]', '$discountArr[$i]', '$taxArr[$i]')";
            if (mysqli_query($dbc, $q)) {
            echo '<script type="text/javascript">
            alert("Data Added Successfully");
            window.open("add_medicine.php","_self")
            </script>';
            exit(); // Stop the page

      }
    }
  }



    }
  }

mysqli_close($dbc);

?>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" />
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" />
           <link rel="stylesheet" type="text/css" media="screen" href="jquery-ui.css" />
            <script src="jquery-ui.js"></script>

<div class="container-fluid">
      <div class="row ml-2 mr-2">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">

      <div class="row pt-md-5 mt-md-3 mb-5">

      <div class="d-flex justify-content-center">
        <div class="col-xl-12 p-2">

        <div class ="breadcrumb">

        <a href="medicine.php"><h6><i class="fa fa-bars text-light mr-3"></i>Medicine List</h6></a>
        <a href="add_medicine.php" class="active"><h6><i class="fa fa-plus-square text-light mr-3"></i>Add Medicine</h6></a>
        <a href="dispatched_medicinelist.php"><h6><i class="fa fa-bars text-light mr-3"></i>Dispatched Medicine List</h6></a>
        <a href="dispatch_medicine.php"><h6><i class="fa fa-plus-square text-light mr-3"></i>Dispatch Medicine</h6></a>
</div>

<div class="col-xl-12 p-2">

<small class="errorText text-danger"><?php echo $error["top"]; ?></small><br>

<div class="row">
<form method="POST" action="add_medicine.php">
            <div class="form-group fieldGroup">
                <div class="input-group">

<div class="col-xl-2 mb-3">Category Name<span class="text-danger"> *</span> </div>

<div class="col-xl-9 mr-2 mb-3">
<select name="medicine_category" class="form-control">
    <option>Select Category</option>
    <option value="5-alpha reductase inhibitor"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '5-alpha reductase inhibitor')) echo ' selected="selected"';?>>5-alpha reductase inhibito</option>
    <option value="5-HT (serotonin) antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '5-HT (serotonin) antagonists')) echo ' selected="selected"';?>>5-HT (serotonin) antagonists</option>
    <option value="ACE inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'ACE inhibitors')) echo ' selected="selected"';?>>ACE inhibitors</option>
    <option value="adrenergic neurone blocker"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'adrenergic neurone blocker')) echo ' selected="selected"';?>>Adrenergic neurone blocker</option>
    <option value="aldosterone inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'aldosterone inhibitors')) echo ' selected="selected"';?>>Aldosterone inhibitors</option>
    <option value="alkalinizing agents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'alkalinizing agents')) echo ' selected="selected"';?>>Alkalinizing agents</option>
    <option value="aminoglycosides"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'aminoglycosides')) echo ' selected="selected"';?>>Aminoglycosides</option>
    <option value="anaesthetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anaesthetics')) echo ' selected="selected"';?>>Anaesthetics</option>
    <option value="Analgesics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Analgesics')) echo ' selected="selected"';?>>Analgesics</option>
    <option value="androgens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'androgens')) echo ' selected="selected"';?>>Androgens</option>
    <option value="angiotensin receptor blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'angiotensin receptor blockers')) echo ' selected="selected"';?>>Angiotensin receptor blockers</option>
    <option value="antacids "<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antacids ')) echo ' selected="selected"';?>>Antacids </option>
    <option value="antiandrogens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiandrogens')) echo ' selected="selected"';?>>Antiandrogens</option>
    <option value="antianginals"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antianginals')) echo ' selected="selected"';?>>Antianginals</option>
    <option value="antiarrhythmics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiarrhythmics')) echo ' selected="selected"';?>>Antiarrhythmics</option>
    <option value="Antibiotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antibiotics')) echo ' selected="selected"';?>>Antibiotics</option>
    <option value="anticholinergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticholinergics')) echo ' selected="selected"';?>>Anticholinergics</option>
    <option value="anticholinesterases"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticholinesterases')) echo ' selected="selected"';?>>Anticholinesterases</option>
    <option value="anticoagulants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticoagulants')) echo ' selected="selected"';?>>Anticoagulants</option>
    <option value="Anticonvulsants/antiepileptics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Anticonvulsants/antiepileptics')) echo ' selected="selected"';?>>Anticonvulsants/antiepileptics</option>
    <option value="antidepressants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidepressants')) echo ' selected="selected"';?>>Antidepressants</option>
    <option value="antidiabetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidiabetics')) echo ' selected="selected"';?>>Antidiabetics</option>
    <option value="antidiarrhoeals"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidiarrhoeals')) echo ' selected="selected"';?>>Antidiarrhoeals</option>
    <option value="antidopaminergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidopaminergics')) echo ' selected="selected"';?>>Antidopaminergics</option>
    <option value="antiemetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiemetics')) echo ' selected="selected"';?>>Antiemetics</option>
    <option value="antifibrinolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antifibrinolytics')) echo ' selected="selected"';?>>Antifibrinolytics</option>
    <option value="antiflatulents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiflatulents')) echo ' selected="selected"';?>>Antiflatulents</option>
    <option value="Anti-glaucoma"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Anti-glaucoma')) echo ' selected="selected"';?>>Anti-glaucoma</option>
    <option value="anti-hemophilic factors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anti-hemophilic factors')) echo ' selected="selected"';?>>Anti-hemophilic factors</option>
    <option value="antihistamines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihistamines')) echo ' selected="selected"';?>>Antihistamines</option>
    <option value="antihistamines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihistamines')) echo ' selected="selected"';?>>Antihistamines</option>
    <option value="antihypertensive"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihypertensive')) echo ' selected="selected"';?>>Antihypertensive</option>
    <option value="Antimalarial"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antimalarial')) echo ' selected="selected"';?>>Antimalarial</option>
    <option value="antiplatelet drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiplatelet drugs')) echo ' selected="selected"';?>>Antiplatelet drugs</option>
    <option value="antipsychotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antipsychotics')) echo ' selected="selected"';?>>Antipsychotics</option>
    <option value="Antipyretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antipyretics')) echo ' selected="selected"';?>>Antipyretics</option>
    <option value="Antiseptics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antiseptics')) echo ' selected="selected"';?>>Antiseptics</option>
    <option value="antispasmodic"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antispasmodic')) echo ' selected="selected"';?>>Antispasmodic</option>
    <option value="antispasmodics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antispasmodics')) echo ' selected="selected"';?>>Antispasmodics</option>
    <option value="antitussives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antitussives')) echo ' selected="selected"';?>>Antitussives</option>
    <option value="Antiviral drug"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antiviral drug')) echo ' selected="selected"';?>>Antiviral drug</option>
    <option value="anxiolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anxiolytics')) echo ' selected="selected"';?>>Anxiolytics</option>
    <option value="astringent"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'astringent')) echo ' selected="selected"';?>>Astringent</option>
    <option value="barbiturates"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'barbiturates')) echo ' selected="selected"';?>>Barbiturates</option>
    <option value="benzodiazepines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'benzodiazepines')) echo ' selected="selected"';?>>Benzodiazepines</option>
    <option value="beta-blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'beta-blockers')) echo ' selected="selected"';?>>Beta-blockers</option>
    <option value="beta-receptor agonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'beta-receptor agonists')) echo ' selected="selected"';?>>Beta-receptor agonists</option>
    <option value="bile acid sequestrants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bile acid sequestrants')) echo ' selected="selected"';?>>Bile acid sequestrants</option>
    <option value="bone regulators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bone regulators')) echo ' selected="selected"';?>>Bone regulators</option>
    <option value="bronchodilators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bronchodilators')) echo ' selected="selected"';?>>Bronchodilators</option>
    <option value="calcium channel blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'calcium channel blockers')) echo ' selected="selected"';?>>Calcium channel blockers</option>
    <option value="cannabinoids"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cannabinoids')) echo ' selected="selected"';?>>Cannabinoids</option>
    <option value="cardiac glycosides"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cardiac glycosides')) echo ' selected="selected"';?>>Cardiac glycosides</option>
    <option value="cerumenolytic"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cerumenolytic')) echo ' selected="selected"';?>>Cerumenolytic</option>
    <option value="cholinergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cholinergics')) echo ' selected="selected"';?>>Cholinergics</option>
    <option value="clomiphene"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'clomiphene')) echo ' selected="selected"';?>>Clomiphene</option>
    <option value="corticosteroids"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'corticosteroids')) echo ' selected="selected"';?>>Corticosteroids</option>
    <option value="cyclopyrrolones"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cyclopyrrolones')) echo ' selected="selected"';?>>Cyclopyrrolones</option>
    <option value="cytoprotectants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cytoprotectants')) echo ' selected="selected"';?>>Cytoprotectants</option>
    <option value="decongestants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'decongestants')) echo ' selected="selected"';?>>Decongestants</option>
    <option value="Diethylstilbestrol"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Diethylstilbestrol')) echo ' selected="selected"';?>>Diethylstilbestrol</option>
    <option value="diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'diuretics')) echo ' selected="selected"';?>>Diuretics</option>
    <option value="dopamine agonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'dopamine agonists')) echo ' selected="selected"';?>>Dopamine agonists</option>
    <option value="dopamine antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'dopamine antagonists')) echo ' selected="selected"';?>>Dopamine antagonists</option>
    <option value="emetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'emetics')) echo ' selected="selected"';?>>Emetics</option>
    <option value="estrogens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'estrogens')) echo ' selected="selected"';?>>Estrogens</option>
    <option value="eugeroics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'eugeroics')) echo ' selected="selected"';?>>Eugeroics</option>
    <option value="fertility medications"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'fertility medications')) echo ' selected="selected"';?>>Fertility medications</option>
    <option value="fibrinolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'fibrinolytics')) echo ' selected="selected"';?>>Fibrinolytics</option>
    <option value="follicle stimulating hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'follicle stimulating hormone')) echo ' selected="selected"';?>>Follicle stimulating hormone</option>
    <option value="gamolenic acid"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gamolenic acid')) echo ' selected="selected"';?>>Gamolenic acid</option>
    <option value="gonadorelin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadorelin')) echo ' selected="selected"';?>>Gonadorelin</option>
    <option value="gonadotropin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadotropin')) echo ' selected="selected"';?>>Gonadotropin</option>
    <option value="gonadotropin release inhibitor"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadotropin release inhibitor')) echo ' selected="selected"';?>>Gonadotropin release inhibitor</option>
    <option value="H2-receptor antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'H2-receptor antagonists')) echo ' selected="selected"';?>>H2-receptor antagonists</option>
    <option value="haemostatic drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'haemostatic drugs')) echo ' selected="selected"';?>>Haemostatic drugs</option>
    <option value="heparin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'heparin')) echo ' selected="selected"';?>>heparin</option>
    <option value="Hormonal contraception"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormonal contraception')) echo ' selected="selected"';?>>Hormonal contraception</option>
    <option value="Hormone Replacement Therapy (HRT)"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormone Replacement Therapy (HRT)')) echo ' selected="selected"';?>>Hormone Replacement Therapy (HRT)</option>
    <option value="Hormone replacements"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormone replacements')) echo ' selected="selected"';?>>Hormone replacements</option>
    <option value="human growth hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'human growth hormone')) echo ' selected="selected"';?>>Human growth hormone</option>
    <option value="hypnotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'hypnotics')) echo ' selected="selected"';?>>Hypnotics</option>
    <option value="hypolipidaemic agents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'hypolipidaemic agents')) echo ' selected="selected"';?>>hypolipidaemic agents</option>
    <option value="Injection"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Injection')) echo ' selected="selected"';?>>Injection</option>
    <option value="insulin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'insulin')) echo ' selected="selected"';?>>Insulin</option>
    <option value="laxatives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'laxatives')) echo ' selected="selected"';?>>Laxatives</option>
    <option value="LHRH"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'LHRH')) echo ' selected="selected"';?>>LHRH</option>
    <option value="loop diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'loop diuretics')) echo ' selected="selected"';?>>Loop Diuretics</option>
    <option value="luteinising hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'luteinising hormone')) echo ' selected="selected"';?>>Luteinising Hormone</option>
    <option value="miotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'miotics')) echo ' selected="selected"';?>>miotics</option>
    <option value="Mood stabilizers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Mood stabilizers')) echo ' selected="selected"';?>>Mood Stabilizers</option>
    <option value="mucolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'mucolytics')) echo ' selected="selected"';?>>mucolytics</option>
    <option value="muscle relaxants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'muscle relaxants')) echo ' selected="selected"';?>>Muscle Relaxants</option>
    <option value="neuromuscular drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'neuromuscular drugs')) echo ' selected="selected"';?>>Neuromuscular Drugs</option>
    <option value="nitrate"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'nitrate')) echo ' selected="selected"';?>>Nitrate</option>
    <option value="NSAIDs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'NSAIDs')) echo ' selected="selected"';?>>NSAIDs</option>
    <option value="oestrogen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'oestrogen')) echo ' selected="selected"';?>>Oestrogen</option>
    <option value="opioid"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'opioid')) echo ' selected="selected"';?>>Opioid</option>
    <option value="Oral contraceptives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Oral contraceptives')) echo ' selected="selected"';?>>Oral Contraceptives</option>
    <option value="Ormeloxifene"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Ormeloxifene')) echo ' selected="selected"';?>>Ormeloxifene</option>
    <option value="parasympathomimetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'parasympathomimetics')) echo ' selected="selected"';?>>Parasympathomimetics</option>
    <option value="progestogen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'progestogen')) echo ' selected="selected"';?>>Progestogen</option>
    <option value="prostaglandin analogues"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'prostaglandin analogues')) echo ' selected="selected"';?>>Prostaglandin Analogues</option>
    <option value="prostaglandins"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'prostaglandins')) echo ' selected="selected"';?>>Prostaglandins</option>
    <option value="proton pump inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'proton pump inhibitors')) echo ' selected="selected"';?>>Proton Pump Inhibitors</option>
    <option value="Psychedelics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Psychedelics')) echo ' selected="selected"';?>>Psychedelics</option>
    <option value="quinolones"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'quinolones')) echo ' selected="selected"';?>>Quinolones</option>
    <option value="reflux suppressants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'reflux suppressants')) echo ' selected="selected"';?>>Reflux Suppressants</option>
    <option value="selective alpha-1 blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'selective alpha-1 blockers')) echo ' selected="selected"';?>>Selective Alpha-1 Blockers</option>
    <option value="sildenafils"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sildenafils')) echo ' selected="selected"';?>>Sildenafils</option>
    <option value="Spermicide"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Spermicide')) echo ' selected="selected"';?>>Spermicide</option>
    <option value="Statins"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Statins')) echo ' selected="selected"';?>>Statins</option>
    <option value="Stimulants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Stimulants')) echo ' selected="selected"';?>>Stimulants</option>
    <option value="sulfa drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sulfa drugs')) echo ' selected="selected"';?>>Sulfa drugs</option>
    <option value="sympathomimetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sympathomimetics')) echo ' selected="selected"';?>>Sympathomimetics</option>
    <option value="tamoxifen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'tamoxifen')) echo ' selected="selected"';?>>Tamoxifen</option>
    <option value="thiazide diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'thiazide diuretics')) echo ' selected="selected"';?>>Thiazide Diuretics</option>
    <option value="topical antibiotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'topical antibiotics')) echo ' selected="selected"';?>>Topical Antibiotics</option>
    <option value="Tranquilizers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Tranquilizers')) echo ' selected="selected"';?>>Tranquilizers</option>
    <option value="vasoconstrictors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'vasoconstrictors')) echo ' selected="selected"';?>>Vasoconstrictors</option>
    <option value="vasodilators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'vasodilators')) echo ' selected="selected"';?>>Vasodilators</option>
    <option value="?? blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '?? blockers')) echo ' selected="selected"';?>>?? Blockers</option>
    <option value="??-receptor blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '??-receptor blockers')) echo ' selected="selected"';?>>??-receptor blockers</option>

    <small class="errorText text-danger"><?php echo $error["medicine_category"]; ?></small><br>

    </select>
    </div>
    <div class="col-xl-2 mb-3">Medicine<span class="text-danger"> *</span></div>

    <div class="col-xl-3 mb-3"><input type="text" name="medicine_name[]" placeholder="Medicine Name" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['medicine_name[]'])) echo $trimmed['medicine_name']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["medicine_name"]; ?></small><br>

        <div class="col-xl-6 mb-3"><textarea name="description[]" placeholder="Description" rows="1" cols="40" class="form-control" maxlength="255"
        value= "<?php if (isset($trimmed['description[]'])) echo $trimmed['description']; ?>"></textarea></div>

        <small class="errorText text-danger"><?php echo $error["description"]; ?></small><br>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><input type="text" name="batch_number[]" placeholder="Batch Number" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['batch_number[]'])) echo $trimmed['batch_number']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["batch_number"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="quantity[]" placeholder="Quantity" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['quantity[]'])) echo $trimmed['quantity']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["quantity"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="price[]" placeholder="Price &#8358" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['price[]'])) echo $trimmed['price']; ?>"></div>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><input type="text" name="manufacturer_name[]" placeholder="Manufacturer Company Name" class="form-control"
        value= "<?php if (isset($trimmed['manufacturer_name[]'])) echo $trimmed['manufacturer_name']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["manufacturer_name"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="text" name="manufactured_date[]" placeholder="Manufactured Date" class="form-control" id="date"
        value= "<?php if (isset($trimmed['manufactured_date[]'])) echo $trimmed['manufactured_date']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["manufactured_date"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="text" name="expired_date[]" placeholder="Expired Date" class="form-control" id="date2"
        value= "<?php if (isset($trimmed['expired_date[]'])) echo $trimmed['expired_date']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["expired_date"]; ?></small><br>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><textarea name="note[]" placeholder="Note" rows="1" cols="40" class="form-control" maxlength="255"
        value= "<?php if (isset($trimmed['note[]'])) echo $trimmed['note']; ?>"></textarea></div>

        <small class="errorText text-danger"><?php echo $error["note"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="discount[]" placeholder="Discount" class="form-control"
        value= "<?php if (isset($trimmed['discount[]'])) echo $trimmed['discount']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["discount"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="tax[]" placeholder="Tax" class="form-control"
        value= "<?php if (isset($trimmed['tax[]'])) echo $trimmed['tax']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["tax"]; ?></small><br>
</div>
</div>

<div class="col-xl-12 mb-3">
<div class="d-flex justify-content-center">

            <div class="mb-2 mr-4">
            <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-light addMore">Add More Medicine</a>
            </div>
            </div>

            <div class="mb-2">
            <input type="submit" name="submit" class="btn btn-info" value="SAVE"/>
</div>
</div>
</div>
</form>

<!-- copy of input fields group -->

<div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
<div class="col-xl-2 mb-3"> </div>
    <div class="col-xl-9 mr-2 mb-3">
    <select name="medicine_category" class="form-control">
        <option>Select Category</option>
        <option value="5-alpha reductase inhibitor"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '5-alpha reductase inhibitor')) echo ' selected="selected"';?>>5-alpha reductase inhibito</option>
        <option value="5-HT (serotonin) antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '5-HT (serotonin) antagonists')) echo ' selected="selected"';?>>5-HT (serotonin) antagonists</option>
        <option value="ACE inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'ACE inhibitors')) echo ' selected="selected"';?>>ACE inhibitors</option>
        <option value="adrenergic neurone blocker"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'adrenergic neurone blocker')) echo ' selected="selected"';?>>Adrenergic neurone blocker</option>
        <option value="aldosterone inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'aldosterone inhibitors')) echo ' selected="selected"';?>>Aldosterone inhibitors</option>
        <option value="alkalinizing agents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'alkalinizing agents')) echo ' selected="selected"';?>>Alkalinizing agents</option>
        <option value="aminoglycosides"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'aminoglycosides')) echo ' selected="selected"';?>>Aminoglycosides</option>
        <option value="anaesthetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anaesthetics')) echo ' selected="selected"';?>>Anaesthetics</option>
        <option value="Analgesics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Analgesics')) echo ' selected="selected"';?>>Analgesics</option>
        <option value="androgens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'androgens')) echo ' selected="selected"';?>>Androgens</option>
        <option value="angiotensin receptor blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'angiotensin receptor blockers')) echo ' selected="selected"';?>>Angiotensin receptor blockers</option>
        <option value="antacids "<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antacids ')) echo ' selected="selected"';?>>Antacids </option>
        <option value="antiandrogens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiandrogens')) echo ' selected="selected"';?>>Antiandrogens</option>
        <option value="antianginals"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antianginals')) echo ' selected="selected"';?>>Antianginals</option>
        <option value="antiarrhythmics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiarrhythmics')) echo ' selected="selected"';?>>Antiarrhythmics</option>
        <option value="Antibiotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antibiotics')) echo ' selected="selected"';?>>Antibiotics</option>
        <option value="anticholinergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticholinergics')) echo ' selected="selected"';?>>Anticholinergics</option>
        <option value="anticholinesterases"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticholinesterases')) echo ' selected="selected"';?>>Anticholinesterases</option>
        <option value="anticoagulants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anticoagulants')) echo ' selected="selected"';?>>Anticoagulants</option>
        <option value="Anticonvulsants/antiepileptics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Anticonvulsants/antiepileptics')) echo ' selected="selected"';?>>Anticonvulsants/antiepileptics</option>
        <option value="antidepressants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidepressants')) echo ' selected="selected"';?>>Antidepressants</option>
        <option value="antidiabetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidiabetics')) echo ' selected="selected"';?>>Antidiabetics</option>
        <option value="antidiarrhoeals"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidiarrhoeals')) echo ' selected="selected"';?>>Antidiarrhoeals</option>
        <option value="antidopaminergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antidopaminergics')) echo ' selected="selected"';?>>Antidopaminergics</option>
        <option value="antiemetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiemetics')) echo ' selected="selected"';?>>Antiemetics</option>
        <option value="antifibrinolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antifibrinolytics')) echo ' selected="selected"';?>>Antifibrinolytics</option>
        <option value="antiflatulents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiflatulents')) echo ' selected="selected"';?>>Antiflatulents</option>
        <option value="Anti-glaucoma"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Anti-glaucoma')) echo ' selected="selected"';?>>Anti-glaucoma</option>
        <option value="anti-hemophilic factors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anti-hemophilic factors')) echo ' selected="selected"';?>>Anti-hemophilic factors</option>
        <option value="antihistamines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihistamines')) echo ' selected="selected"';?>>Antihistamines</option>
        <option value="antihistamines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihistamines')) echo ' selected="selected"';?>>Antihistamines</option>
        <option value="antihypertensive"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antihypertensive')) echo ' selected="selected"';?>>Antihypertensive</option>
        <option value="Antimalarial"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antimalarial')) echo ' selected="selected"';?>>Antimalarial</option>
        <option value="antiplatelet drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antiplatelet drugs')) echo ' selected="selected"';?>>Antiplatelet drugs</option>
        <option value="antipsychotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antipsychotics')) echo ' selected="selected"';?>>Antipsychotics</option>
        <option value="Antipyretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antipyretics')) echo ' selected="selected"';?>>Antipyretics</option>
        <option value="Antiseptics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antiseptics')) echo ' selected="selected"';?>>Antiseptics</option>
        <option value="antispasmodic"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antispasmodic')) echo ' selected="selected"';?>>Antispasmodic</option>
        <option value="antispasmodics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antispasmodics')) echo ' selected="selected"';?>>Antispasmodics</option>
        <option value="antitussives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'antitussives')) echo ' selected="selected"';?>>Antitussives</option>
        <option value="Antiviral drug"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Antiviral drug')) echo ' selected="selected"';?>>Antiviral drug</option>
        <option value="anxiolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'anxiolytics')) echo ' selected="selected"';?>>Anxiolytics</option>
        <option value="astringent"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'astringent')) echo ' selected="selected"';?>>Astringent</option>
        <option value="barbiturates"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'barbiturates')) echo ' selected="selected"';?>>Barbiturates</option>
        <option value="benzodiazepines"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'benzodiazepines')) echo ' selected="selected"';?>>Benzodiazepines</option>
        <option value="beta-blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'beta-blockers')) echo ' selected="selected"';?>>Beta-blockers</option>
        <option value="beta-receptor agonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'beta-receptor agonists')) echo ' selected="selected"';?>>Beta-receptor agonists</option>
        <option value="bile acid sequestrants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bile acid sequestrants')) echo ' selected="selected"';?>>Bile acid sequestrants</option>
        <option value="bone regulators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bone regulators')) echo ' selected="selected"';?>>Bone regulators</option>
        <option value="bronchodilators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'bronchodilators')) echo ' selected="selected"';?>>Bronchodilators</option>
        <option value="calcium channel blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'calcium channel blockers')) echo ' selected="selected"';?>>Calcium channel blockers</option>
        <option value="cannabinoids"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cannabinoids')) echo ' selected="selected"';?>>Cannabinoids</option>
        <option value="cardiac glycosides"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cardiac glycosides')) echo ' selected="selected"';?>>Cardiac glycosides</option>
        <option value="cerumenolytic"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cerumenolytic')) echo ' selected="selected"';?>>Cerumenolytic</option>
        <option value="cholinergics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cholinergics')) echo ' selected="selected"';?>>Cholinergics</option>
        <option value="clomiphene"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'clomiphene')) echo ' selected="selected"';?>>Clomiphene</option>
        <option value="corticosteroids"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'corticosteroids')) echo ' selected="selected"';?>>Corticosteroids</option>
        <option value="cyclopyrrolones"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cyclopyrrolones')) echo ' selected="selected"';?>>Cyclopyrrolones</option>
        <option value="cytoprotectants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'cytoprotectants')) echo ' selected="selected"';?>>Cytoprotectants</option>
        <option value="decongestants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'decongestants')) echo ' selected="selected"';?>>Decongestants</option>
        <option value="Diethylstilbestrol"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Diethylstilbestrol')) echo ' selected="selected"';?>>Diethylstilbestrol</option>
        <option value="diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'diuretics')) echo ' selected="selected"';?>>Diuretics</option>
        <option value="dopamine agonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'dopamine agonists')) echo ' selected="selected"';?>>Dopamine agonists</option>
        <option value="dopamine antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'dopamine antagonists')) echo ' selected="selected"';?>>Dopamine antagonists</option>
        <option value="emetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'emetics')) echo ' selected="selected"';?>>Emetics</option>
        <option value="estrogens"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'estrogens')) echo ' selected="selected"';?>>Estrogens</option>
        <option value="eugeroics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'eugeroics')) echo ' selected="selected"';?>>Eugeroics</option>
        <option value="fertility medications"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'fertility medications')) echo ' selected="selected"';?>>Fertility medications</option>
        <option value="fibrinolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'fibrinolytics')) echo ' selected="selected"';?>>Fibrinolytics</option>
        <option value="follicle stimulating hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'follicle stimulating hormone')) echo ' selected="selected"';?>>Follicle stimulating hormone</option>
        <option value="gamolenic acid"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gamolenic acid')) echo ' selected="selected"';?>>Gamolenic acid</option>
        <option value="gonadorelin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadorelin')) echo ' selected="selected"';?>>Gonadorelin</option>
        <option value="gonadotropin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadotropin')) echo ' selected="selected"';?>>Gonadotropin</option>
        <option value="gonadotropin release inhibitor"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'gonadotropin release inhibitor')) echo ' selected="selected"';?>>Gonadotropin release inhibitor</option>
        <option value="H2-receptor antagonists"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'H2-receptor antagonists')) echo ' selected="selected"';?>>H2-receptor antagonists</option>
        <option value="haemostatic drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'haemostatic drugs')) echo ' selected="selected"';?>>Haemostatic drugs</option>
        <option value="heparin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'heparin')) echo ' selected="selected"';?>>heparin</option>
        <option value="Hormonal contraception"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormonal contraception')) echo ' selected="selected"';?>>Hormonal contraception</option>
        <option value="Hormone Replacement Therapy (HRT)"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormone Replacement Therapy (HRT)')) echo ' selected="selected"';?>>Hormone Replacement Therapy (HRT)</option>
        <option value="Hormone replacements"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Hormone replacements')) echo ' selected="selected"';?>>Hormone replacements</option>
        <option value="human growth hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'human growth hormone')) echo ' selected="selected"';?>>Human growth hormone</option>
        <option value="hypnotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'hypnotics')) echo ' selected="selected"';?>>Hypnotics</option>
        <option value="hypolipidaemic agents"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'hypolipidaemic agents')) echo ' selected="selected"';?>>hypolipidaemic agents</option>
        <option value="Injection"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Injection')) echo ' selected="selected"';?>>Injection</option>
        <option value="insulin"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'insulin')) echo ' selected="selected"';?>>Insulin</option>
        <option value="laxatives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'laxatives')) echo ' selected="selected"';?>>Laxatives</option>
        <option value="LHRH"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'LHRH')) echo ' selected="selected"';?>>LHRH</option>
        <option value="loop diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'loop diuretics')) echo ' selected="selected"';?>>Loop Diuretics</option>
        <option value="luteinising hormone"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'luteinising hormone')) echo ' selected="selected"';?>>Luteinising Hormone</option>
        <option value="miotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'miotics')) echo ' selected="selected"';?>>miotics</option>
        <option value="Mood stabilizers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Mood stabilizers')) echo ' selected="selected"';?>>Mood Stabilizers</option>
        <option value="mucolytics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'mucolytics')) echo ' selected="selected"';?>>mucolytics</option>
        <option value="muscle relaxants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'muscle relaxants')) echo ' selected="selected"';?>>Muscle Relaxants</option>
        <option value="neuromuscular drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'neuromuscular drugs')) echo ' selected="selected"';?>>Neuromuscular Drugs</option>
        <option value="nitrate"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'nitrate')) echo ' selected="selected"';?>>Nitrate</option>
        <option value="NSAIDs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'NSAIDs')) echo ' selected="selected"';?>>NSAIDs</option>
        <option value="oestrogen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'oestrogen')) echo ' selected="selected"';?>>Oestrogen</option>
        <option value="opioid"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'opioid')) echo ' selected="selected"';?>>Opioid</option>
        <option value="Oral contraceptives"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Oral contraceptives')) echo ' selected="selected"';?>>Oral Contraceptives</option>
        <option value="Ormeloxifene"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Ormeloxifene')) echo ' selected="selected"';?>>Ormeloxifene</option>
        <option value="parasympathomimetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'parasympathomimetics')) echo ' selected="selected"';?>>Parasympathomimetics</option>
        <option value="progestogen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'progestogen')) echo ' selected="selected"';?>>Progestogen</option>
        <option value="prostaglandin analogues"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'prostaglandin analogues')) echo ' selected="selected"';?>>Prostaglandin Analogues</option>
        <option value="prostaglandins"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'prostaglandins')) echo ' selected="selected"';?>>Prostaglandins</option>
        <option value="proton pump inhibitors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'proton pump inhibitors')) echo ' selected="selected"';?>>Proton Pump Inhibitors</option>
        <option value="Psychedelics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Psychedelics')) echo ' selected="selected"';?>>Psychedelics</option>
        <option value="quinolones"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'quinolones')) echo ' selected="selected"';?>>Quinolones</option>
        <option value="reflux suppressants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'reflux suppressants')) echo ' selected="selected"';?>>Reflux Suppressants</option>
        <option value="selective alpha-1 blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'selective alpha-1 blockers')) echo ' selected="selected"';?>>Selective Alpha-1 Blockers</option>
        <option value="sildenafils"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sildenafils')) echo ' selected="selected"';?>>Sildenafils</option>
        <option value="Spermicide"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Spermicide')) echo ' selected="selected"';?>>Spermicide</option>
        <option value="Statins"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Statins')) echo ' selected="selected"';?>>Statins</option>
        <option value="Stimulants"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Stimulants')) echo ' selected="selected"';?>>Stimulants</option>
        <option value="sulfa drugs"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sulfa drugs')) echo ' selected="selected"';?>>Sulfa drugs</option>
        <option value="sympathomimetics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'sympathomimetics')) echo ' selected="selected"';?>>Sympathomimetics</option>
        <option value="tamoxifen"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'tamoxifen')) echo ' selected="selected"';?>>Tamoxifen</option>
        <option value="thiazide diuretics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'thiazide diuretics')) echo ' selected="selected"';?>>Thiazide Diuretics</option>
        <option value="topical antibiotics"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'topical antibiotics')) echo ' selected="selected"';?>>Topical Antibiotics</option>
        <option value="Tranquilizers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'Tranquilizers')) echo ' selected="selected"';?>>Tranquilizers</option>
        <option value="vasoconstrictors"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'vasoconstrictors')) echo ' selected="selected"';?>>Vasoconstrictors</option>
        <option value="vasodilators"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == 'vasodilators')) echo ' selected="selected"';?>>Vasodilators</option>
        <option value="?? blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '?? blockers')) echo ' selected="selected"';?>>?? Blockers</option>
        <option value="??-receptor blockers"<?php if (isset($trimmed['medicine_category']) && ($trimmed['medicine_category'] == '??-receptor blockers')) echo ' selected="selected"';?>>??-receptor blockers</option>

        <small class="errorText text-danger"><?php echo $error["medicine_category"]; ?></small><br>

        </select>
        </div>

    <div class="col-xl-2 mb-3"></div>
    <div class="col-xl-3 mb-3"><input type="text" name="medicine_name[]" placeholder="Medicine Name" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['medicine_name[]'])) echo $trimmed['medicine_name']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["medicine_name"]; ?></small><br>

        <div class="col-xl-6 mb-3"><textarea name="description[]" placeholder="Description" rows="1" cols="40" class="form-control" maxlength="255"
        value= "<?php if (isset($trimmed['description[]'])) echo $trimmed['description']; ?>"></textarea></div>

        <small class="errorText text-danger"><?php echo $error["description"]; ?></small><br>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><input type="text" name="batch_number[]" placeholder="Batch Number" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['batch_number[]'])) echo $trimmed['batch_number']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["batch_number"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="quantity[]" placeholder="Quantity" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['quantity[]'])) echo $trimmed['quantity']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["quantity"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="price[]" placeholder="Price &#8358" class="form-control" maxlength="20"
        value= "<?php if (isset($trimmed['price[]'])) echo $trimmed['price']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["price"]; ?></small><br>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><input type="text" name="manufacturer_name[]" placeholder="Manufacturer Company Name" class="form-control"
        value= "<?php if (isset($trimmed['manufacturer_name[]'])) echo $trimmed['manufacturer_name']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["manufacturer_name"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="date" name="manufactured_date[]" placeholder="Manufactured Date" class="form-control"
        value= "<?php if (isset($trimmed['manufactured_date[]'])) echo $trimmed['manufactured_date']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["manufactured_date"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="date" name="expired_date[]" placeholder="Expired Date" class="form-control"
        value= "<?php if (isset($trimmed['expired_date[]'])) echo $trimmed['expired_date']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["expired_date"]; ?></small><br>

        <div class="col-xl-2 mb-3"></div>

        <div class="col-xl-3 mb-3"><textarea name="note[]" placeholder="Note" rows="1" cols="40" class="form-control" maxlength="255"
        value= "<?php if (isset($trimmed['note[]'])) echo $trimmed['note']; ?>"></textarea></div>

        <small class="errorText text-danger"><?php echo $error["note"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="discount[]" placeholder="Discount" class="form-control"
        value= "<?php if (isset($trimmed['discount[]'])) echo $trimmed['discount']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["discount"]; ?></small><br>

        <div class="col-xl-3 mb-3"><input type="number" name="tax[]" placeholder="Tax" class="form-control"
        value= "<?php if (isset($trimmed['tax[]'])) echo $trimmed['tax']; ?>"></div>

        <small class="errorText text-danger"><?php echo $error["tax"]; ?></small><br>

        <div class="col-xl-1 mb-3">
        <div class="input-group-addon">
            <a href="javascript:void(0)" class="btn btn-light remove"><em>Delete</em></a>
        </div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</div>

<script>

$(document).ready(function(){
    //group add limit
    var maxGroup = 10;

    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click",".remove",function(){
        $(this).parents(".fieldGroup").remove();
    });
});

</script>

<script type = "text/javascript">
        $(document).ready(function () {
            $('#date').datepicker({
                changeMonth: true,
                changeYear: true
            })
        })
    </script>

<script type = "text/javascript">
        $(document).ready(function () {
               $('#date2').datepicker({
                changeMonth: true,
                changeYear: true
            })
        })
    </script>

</div>
</div>
</div>

<?php
include('../Gincludes/footer.php');
include('../Gincludes/mfoot.php');

?>
