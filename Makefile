# Copyright (c) 2012 Francisco José Rodríguez Bogado <bogado@qinn.es>

all 	: musicona discazo random

musicona:
	cd com_musicona && zip -r ../com_musicona.zip * 

discazo:
	cd mod_discazo && zip -r ../mod_discazo.zip * 

random: 
	cd mod_song_random && zip -r ../mod_song_random.zip *

clean:
	rm mod_song_random.zip mod_discazo.zip com_musicona.zip

