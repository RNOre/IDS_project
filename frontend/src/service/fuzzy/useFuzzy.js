function handleSubmit(event) {
    event.preventDefault(); // Menghentikan submit form untuk mencegah refresh halaman

    const Olimp = document.getElementById("inputDistance").value;
    const Study = document.getElementById("inputSpeed").value;

    // Fuzzification of distance (jarak)
    const [OMin, OMid, OMax] = fuzzification(Olimp, 100, 150, 200);
    console.log(OMin, OMid, OMax)
    const oDekat = document.getElementById("outputDekat");
    const oSedang = document.getElementById("outputDekat");
    const oJauh = document.getElementById("outputJauh");

    oDekat.value = OMin;
    oSedang.value = OMid;
    oJauh.value = OMax;

    // Fuzzification of speed (kecepatan)
    const [SMin, SMid, SMax] = fuzzification(Study, 30, 50, 70);

    const oLambat = document.getElementById("outputLambat");
    const oStandar = document.getElementById("outputStandar");
    const oCepat = document.getElementById("outputCepat");

    oLambat.value = SMin;
    oStandar.value = SMid;
    oCepat.value = SMax;

    // Applying rules to determine the conclusion
    let low = { temp: 0, conclusion: 0 };
    let middle = { temp: 0, conclusion: 0 };
    let hight = { temp: 0, conclusion: 0 };
    andRules(OMin, SMin, low);
    andRules(OMin, SMid, low);
    andRules(OMin, SMax, low);
    andRules(OMid, SMin, middle);
    andRules(OMid, SMid, middle);
    andRules(OMid, SMax, middle);
    andRules(OMax, SMin, middle);
    andRules(OMax, SMid, hight);
    andRules(OMax, SMax, hight);

    const oKurang = document.getElementById("outputKurang");
    const oTahan = document.getElementById("outputTahan");
    const oTambah = document.getElementById("outputTambah");

    oKurang.value = low.conclusion;
    oTahan.value = middle.conclusion;
    oTambah.value = hight.conclusion;

    // Determining the sample values for defuzzification
    const [sample1, sample2, sample3] = determineSample(0, 25, 75, 100);

    const oSample1 = document.getElementById("outputSample1");
    const oSample2 = document.getElementById("outputSample2");
    const oSample3 = document.getElementById("outputSample3");

    oSample1.value = sample1;
    oSample2.value = sample2;
    oSample3.value = sample3;

    // Defuzzification to calculate the reward
    const reward = defuzzification(
        low.conclusion,
        middle.conclusion,
        hight.conclusion,
        sample1,
        sample2,
        sample3
    );

    const oReward = document.getElementById("outputReward");

    oReward.value = reward;
}
