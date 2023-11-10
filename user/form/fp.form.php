<style>
    body {
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        padding: 20px;
        background: #fff;
    }

    form {
        background: #f7f7f7;
        padding: 20px;
        border: 1px solid #ddd;
    }

    fieldset {
        border: 1px solid #aaa;
        padding: 10px;
        margin-bottom: 20px;
    }

    legend {
        padding: 0 5px;
        font-weight: bold;
        font-size: 14px;
    }

    label,
    .checkbox-group label {
        margin: 5px 0;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    .checkbox-group input[type="text"] {
        border: 1px solid #aaa;
        padding: 5px;
        margin-top: 2px;
        width: calc(100% - 12px);
        /* Adjust width as needed, accounting for padding and border */
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        background: #0056b3;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
    }

    .col {
        align-items: flex-start;
    }

    .inline-label,
    .col .radio-group label,
    .col .checkbox-group label {
        display: inline-block;
        margin-right: 15px;
    }

    .conditional {
        margin-left: 20px;
        display: none;
        /* This will be controlled with JavaScript if needed */
    }

    @media (max-width: 600px) {
        .grid {
            grid-template-columns: 1fr;
        }

        .inline-label,
        .col .radio-group label,
        .col .checkbox-group label,
        .checkbox-group input[type="text"] {
            display: block;
            margin-right: 0;
        }

        .conditional {
            margin-left: 0;
        }
    }
</style>
<form action="/submit-form" method="post" class="medical-form">


    <!-- Medical History Section -->
    <fieldset>
        <legend>I. MEDICAL HISTORY</legend>
        <div class="grid">
            <div class="col">
                <label><input type="checkbox" name="severe_headaches" value="severe_headaches"> Severe
                    headaches/migraine</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="history_stroke_heart_attack_hypertension"
                        value="history_stroke_heart_attack_hypertension">History of stroke/ Heart attack/
                    Hypertension</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="non_traumatic_hematoma" value="non_traumatic_hematoma">Non Traumatic
                    hematoma/ Frequent bruising</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="breast_cancer_history" value="breast_cancer_history">Current or
                    history of breast cancer</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="severe_chest_pain" value="severe_chest_pain"> Severe chest
                    pain</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="prolonged_cough" value="prolonged_cough">Cough for more than 14
                    Days</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="jaundice" value="jaundice">Jaundice</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="unexplained_vaginal_bleeding"
                        value="unexplained_vaginal_bleeding">Unexplained vaginal bleeding</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="abnormal_vaginal_discharge"
                        value="abnormal_vaginal_discharge">Abnormal vaginal discharge</label>
            </div>
            <div class="col">
                <label><input type="checkbox" name="is_smoker" value="is_smoker">Is the client a Smoker</label>
            </div>
        </div>
    </fieldset>


    <!-- Obstetrical History Section -->
    <fieldset>
        <legend>II. OBSTETRICAL HISTORY</legend>
        <div class="grid">
            <div class="col">
                <label>Number of pregnancies: <input type="text" name="number_of_pregnancies"></label>
            </div>
            <div class="col">
                <label>Date of Last Delivery: <input type="date" name="date_of_last_delivery"></label>
            </div>
            <div class="col">
                <label>Type of last Delivery:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="last_delivery_type" value="vaginal"> Vaginal</label>
                    <label><input type="checkbox" name="last_delivery_type" value="cesarean"> Cesarean Section</label>
                </div>
            </div>
            <div class="col">
                <label>Last menstrual period: <input type="date" name="last_menstrual_period"></label>
                <label>Previous Menstrual period: <input type="date" name="previous_menstrual_period"></label>
            </div>
        </div>
    </fieldset>

    <!-- Risks for Sexually Transmitted Infections Section -->
    <fieldset>
        <legend>III. RISKS FOR SEXUALLY TRANSMITTED INFECTIONS</legend>
        <fieldset>
            <legend>Does the client or the client's partner have any of the following?</legend>
            <div class="grid">
                <div class="col">
                    <label>abnormal discharge from the genital area</label>
                    <label class="inline-label"><input type="radio" name="abnormal_discharge" value="yes"> Yes</label>
                    <label class="inline-label"><input type="radio" name="abnormal_discharge" value="no"> No</label>
                    <div class="conditional">
                        <span>If "YES" please indicate if from:</span>
                        <label class="inline-label"><input type="radio" name="discharge_from" value="vagina">
                            Vagina</label>
                        <label class="inline-label"><input type="radio" name="discharge_from" value="penis">
                            Penis</label>
                    </div>
                </div>
                <div class="col">
                    <label>sores or ulcers in the genital area</label>
                    <label class="inline-label"><input type="radio" name="sores_ulcers" value="yes"> Yes</label>
                    <label class="inline-label"><input type="radio" name="sores_ulcers" value="no"> No</label>
                </div>
                <div class="col">
                    <label>pain or burning sensation in the genital area</label>
                    <label class="inline-label"><input type="radio" name="pain_burning" value="yes"> Yes</label>
                    <label class="inline-label"><input type="radio" name="pain_burning" value="no"> No</label>
                </div>
                <div class="col">
                    <label>history of treatment for sexually transmitted infections</label>
                    <label class="inline-label"><input type="radio" name="history_sti_treatment" value="yes">
                        Yes</label>
                    <label class="inline-label"><input type="radio" name="history_sti_treatment" value="no"> No</label>
                </div>
                <div class="col">
                    <label>HIV/AIDS / Pelvic inflammatory disease</label>
                    <label class="inline-label"><input type="radio" name="hiv_aids" value="yes"> Yes</label>
                    <label class="inline-label"><input type="radio" name="hiv_aids" value="no"> No</label>
                </div>
            </div>
        </fieldset>

    </fieldset>

    <!-- Risks for Violence Against Women Section -->
    <fieldset>
        <legend>IV. RISKS FOR VIOLENCE AGAINST WOMEN (VAW)</legend>
        <div class="grid">
            <div class="col">
                <label>Unpleasant relationship with partner</label>
                <label class="inline-label"><input type="radio" name="unpleasant_relationship" value="yes"> Yes</label>
                <label class="inline-label"><input type="radio" name="unpleasant_relationship" value="no"> No</label>
            </div>
            <div class="col">
                <label>Partner does not approve of the visit to FP clinic</label>
                <label class="inline-label"><input type="radio" name="partner_disapproval" value="yes"> Yes</label>
                <label class="inline-label"><input type="radio" name="partner_disapproval" value="no"> No</label>
            </div>
            <div class="col">
                <label>History of domestic violence or VAW</label>
                <label class="inline-label"><input type="radio" name="domestic_violence_history" value="yes">
                    Yes</label>
                <label class="inline-label"><input type="radio" name="domestic_violence_history" value="no"> No</label>
            </div>
            <div class="col">
                <label>Referred to:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="referred_to" value="dswd"> DSWD</label>
                    <label><input type="checkbox" name="referred_to" value="wcpu"> WCPU</label>
                    <label><input type="checkbox" name="referred_to" value="ngo"> NGOs</label>
                    <label><input type="checkbox" name="referred_to" value="others"> Others (Specify):</label>
                    <input type="text" name="referred_to_others_specify">
                </div>
            </div>
        </div>
    </fieldset>


    <!-- Physical Examination Section -->
    <fieldset>
        <legend>V. PHYSICAL EXAMINATION</legend>

        <div class="row">
        <div class="col">
            <label>Height: (cm) <input type="text" name="height"></label>
            <label>Weight: (kg)<input type="text" name="weight"></label>
            <label>Blood Pressure: (mmHg)<input type="text" name="blood_pressure"></label>
            <label>Pulse Rate: (per min)<input type="text" name="pulse_rate"></label>
        </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <legend>SKIN</legend>
                <div class="col">
                    <label><input type="checkbox" name="skin" value="skin_normal"> Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="skin" value="skin_pale"> Pale</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="skin" value="skin_yellowish"> Yellowish</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="skin" value="skin_hematoma"> Hematoma</label>
                </div>
                <br>
                <legend>CONJUNCTIVA</legend>
                <div class="col">
                    <label><input type="checkbox" name="conjunctive" value="conjunctiva_normal"> Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="conjunctive" value="conjunctiva_pale"> Pale</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="conjunctive" value="conjunctiva_yellowish">
                        Yellowish</label>
                </div>
                <br>
                <legend>NECK</legend>
                <div class="col">
                    <label><input type="checkbox" name="neck" value="neck_normal">Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="neck" value="neck_mass">Neck mass</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="neck" value="neck_lymph_nodes">Enlarged lymph nodes</label>
                </div>
            </div>
            <div class="col">
                <legend>BREAST</legend>
                <div class="col">
                    <label><input type="checkbox" name="breast" value="breast_normal">Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="breast" value="breast_mass">Mass</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="breast" value="breast_nipple_discharge">Nipple
                        Discharge</label>
                </div>
                <br>
                <legend>ABDOMEN</legend>
                <div class="col">
                    <label><input type="checkbox" name="abdomen" value="abdomen_normal">Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="abdomen" value="abdomen_mass">Abdominal Mass</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="abdomen" value="abdomen_varicosities">Varicosities</label>
                </div>
                <br>
                <legend>EXTREMITIES</legend>
                <div class="col">
                    <label><input type="checkbox" name="extremities" value="extremities_normal">Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="extremities" value="extremities_edema">Edema</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="extremities"
                            value="extremities_varicosities">Varicosities</label>
                </div>
            </div>
            <div class="col">
                <legend>PLEVIC EXAMINATION</legend>
                <small>(For IUD Acceptors)</small>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="pelvic_normal">Normal</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="pelvic_mass">Mass</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="pelvic_abnormal">Abnormal Discharge</label>
                </div>
                <br>
                <small>Cervical Abnormalities</small>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_none">None</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_warts">Warts</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_polyp">Polyp or Cyst</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_inflammation">Inflammation or
                        Erotion</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_bloddy">Bloddy Discharge</label>
                </div>
                <br>
                <small>Cervical Consistency</small>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_firm">Firm</label>
                </div>
                <div class="col">
                    <label><input type="checkbox" name="pelvic" value="cervical_soft">Soft</label>
                </div>
            </div>
        </div>
    </fieldset>


    <!-- Acknowledgement Section
    <fieldset>
        <legend>ACKNOWLEDGEMENT</legend>
        <p>This is to certify that the Physician/Nurse/Midwife of the clinic has fully explained to me the different
            methods available in family planning and I freely choose the ________ method.</p>
            <br>
            <legend>Signature</legend>
        <label for="client_signature">Client Signature:</label>
        <input type="text" id="client_signature" name="client_signature">
         Additional inputs for signatures
    </fieldset>

 Signature Section 
    <fieldset>
        
    </fieldset> -->

    <input type="submit" value="Submit">
</form>