function [final_signal,correl,estBPM,cd]=bpm_detection(s)

levels = 4; % # levels of DWT decomposition

[s,fs] = wavread(s);

% anti-aliasing filter
% [num,den] = butter(4, 1/4);
% s = filter(num,den, s);

% s=mean(s'); % convert stereo to  mono

l = length(s);
k = mod(l,2);
s = s(1:l-k);
s1 = buffer(s,3*fs,3*0.5*fs); % framing the signal in 3 sec windows with 50% of overlap
[s_1,s_2] = size(s1);

% initializing the input for the first level of decomposition
ca(1).data = s1;

for k = 1:s_2

   for loop = 2:levels+1;  
   
   [ca(loop).data(:,k),cd(loop).data(:,k)] = dwt(ca(loop-1).data(:,k),'db4'); %discrete wavelet transform with daubechies 4 wavelet
   
   ca(loop).data(:,k) = filter(0.01,[1 -0.99],cd(loop).data(:,k)); % >>   >>      >>      >> (details)

   final_signal(loop).data(:,k) = (abs(cd(loop).data(1:2^(5-loop):end,k))-mean(abs(cd(loop).data(1:2^(5-loop):end,k))));
   
   end

end

for i = 2:5
    S(i-1,1:2) = size(final_signal(i).data);
end
sum5 = zeros(min(S(:,1)),min(S(:,2)));

for i = 2:5
sum5 = sum5 + final_signal(i).data(1:min(S(:,1)),1:min(S(:,2)));
end

K = length(sum5);
%  
for i = 1:s_2
ca(5).data(:,i) = filter(0.01,[1 -0.99],ca(5).data(:,i));
temp(:,i) = abs(ca(5).data(:,i))-mean(abs(ca(5).data(:,i)));
end

temp = temp(1:K,:);
sum5 = sum5 + temp;

for i = 1:s_2
   correl_temp = xcorr(sum5(:,i)); % ACF at summed signal
   correl(:,i) = correl_temp(length(correl_temp)/2 + 1 : end);
   
end

%correl=correl./max(correl); %normalization 
time = ((1:length(s))./ (fs/16)); %creating the time axis
time = time(1:length(time)-1);
 
bpm = 60 ./ time;
I = find(bpm <= 220 & bpm >= 40);
   
bpm2 = bpm(I);

for i=1:s_2
   cM2(:,i) = correl(I(:),i);
   [v(i),p(i)] = max(cM2(:,i));
   estBPM(i) = bpm2(p(i));
end
   
estBPM = median(estBPM); % find the median bpm value of all windows
