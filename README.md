the-BPM-detector
================

Implementation of a Beats Per Minute (BPM) detection algorithm, as presented in the paper of G. Tzanetakis, G. Essl and P. Cook titled: "Audio Analysis using the Discrete Wavelet Transform". 

You can find it here: http://citeseerx.ist.psu.edu/viewdoc/summary?doi=10.1.1.63.5712

Usage

select the .wav file you want to analyze and pass it as an input argument in bpm_detection function as follows:

myfile = 'file.wav';
[final_signal,correl,estBPM,cd] = bpm_detection(myfile)

The above code should be executed in matlab's command line. 

Output

final_signal: the signal after the Discrete Wavelet Transform
correl: Auto-correlation function's coefficients of the summed signal
estBPM: the BMP of the input signal
cd: The details coefficients of each level of DWT decomposition

Or you can use a shorter version, printing out only the BPM.

myfile = 'file.wav';
[estBPM] = bpm_detection(myfile)

In order to achieve that, change the first line of the code in order to look like this: 
function [estBPM]=bpm_detection(s)
