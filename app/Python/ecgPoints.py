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

ecg_signal = nk.as_vector(ecg_signal)

ecg_cleaned = nk.ecg_clean(ecg_signal, sampling_rate=sample_rate)
instant_peaks, rpeaks, = nk.ecg_peaks(ecg_cleaned, sampling_rate=sample_rate)
rate = nk.ecg_rate(rpeaks, sampling_rate=sample_rate, desired_length=len(ecg_cleaned))
quality = nk.ecg_quality(ecg_cleaned, sampling_rate=sample_rate)
instant_waves_peak, waves_peak = nk.ecg_delineate(ecg_cleaned, rpeaks, sampling_rate=sample_rate)

# Prepare output
signals = pd.DataFrame({"ECG_Raw": ecg_signal,
                        "ECG_Clean": ecg_cleaned,
                        "ECG_Rate": rate,
                        "ECG_Quality": quality})
signals = pd.concat([signals, instant_peaks, instant_waves_peak], axis=1)
info = rpeaks

print(json.dumps(signals.to_json(orient="records"),indent=4))
