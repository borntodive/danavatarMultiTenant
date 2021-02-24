import neurokit2 as nk
import numpy as np
import pandas as pd
import json
import sys, getopt

sample_rate = 0

try:
    opts, args = getopt.getopt(sys.argv[1:],"hs:",["srate="])
except getopt.GetoptError:
    print ('ecgPoints.py -s <samplerate>')
    sys.exit(2)
for opt, arg in opts:
    if opt == '-h':
        print ('ecgPoints.py -s <samplerate>')
        sys.exit()
    elif opt in ("-s", "--srate"):
        sample_rate = int(arg)
#sample_rate=125
ecg_signal = pd.read_csv("../storage/app/samples.csv")
ecg = nk.as_vector(ecg_signal)
signals = pd.DataFrame({"ECG_Raw" : ecg,
                        "ECG_NeuroKit" : nk.ecg_clean(ecg, sampling_rate=1000, method="neurokit"),
                        "ECG_BioSPPy" : nk.ecg_clean(ecg, sampling_rate=1000, method="biosppy"),
                        "ECG_PanTompkins" : nk.ecg_clean(ecg, sampling_rate=1000, method="pantompkins1985"),
                        "ECG_Hamilton" : nk.ecg_clean(ecg, sampling_rate=1000, method="hamilton2002"),
                        "ECG_Elgendi" : nk.ecg_clean(ecg, sampling_rate=1000, method="elgendi2010"),
                        "ECG_EngZeeMod" : nk.ecg_clean(ecg, sampling_rate=1000, method="engzeemod2012")})

print(json.dumps(signals.to_json(orient="records"),indent=4))
