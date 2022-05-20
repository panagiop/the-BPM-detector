the-BPM-detector
================

Implementation of a Beats Per Minute (BPM) detection algorithm, as presented in the paper of G. Tzanetakis, G. Essl and P. Cook titled: "Audio Analysis using the Discrete Wavelet Transform". 

You can find it here: http://citeseerx.ist.psu.edu/viewdoc/summary?doi=10.1.1.63.5712

<h2>Usage</h2>

Select the .wav file you want to analyze and pass it as an input argument in bpm_detection function as follows:

<code>myfile = 'file.wav'; [final_signal,correl,estBPM,cd] = bpm_detection(myfile)</code>

The above code should be executed in matlab's command line. 

<h2>Output</h2>

<code>final_signal</code>: the signal after the Discrete Wavelet Transform<br/>
<code>correl</code>: Auto-correlation function's coefficients of the summed signal<br/>
<code>estBPM</code>: the BMP of the input signal<br/>
<code>cd</code>: The details coefficients of each level of DWT decomposition<br/>

Or you can use a shorter version, printing out only the BPM.

<code>myfile = 'file.wav'; [estBPM] = bpm_detection(myfile)</code>

In order to achieve that, change the first line of the code in order to look like this: <code>function [estBPM]=bpm_detection(s)</code>
