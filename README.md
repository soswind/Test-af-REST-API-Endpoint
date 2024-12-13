# Tests af REST API Endpoint
# Beskrivelse
Dette repository indeholder to tests af WordPress REST API integration for JumboTransport:

Basal test - Henter og viser kun titler
Udvidet test - Komplet visning af posts inklusiv billeder, forfattere og metadata

# Test 1: Basal API Integration
Den første test implementerer:

Grundlæggende API-forbindelse
Simpel fejlhåndtering
Basal visning af post-titler
Authentication håndtering

# Anvendelse
Brug shortcode:
- [vis_news_dk_data]

# Test 2: Udvidet API Integration
Den anden test udbygger funktionaliteten med:
Komplet visning af posts inklusiv:

- Titel
- Dato
- Indhold
- Uddrag
- Forfatter ID og navn
- Post status
- Featured image (hvis tilgængeligt)
- Responsive billeder
- Forbedret fejlhåndtering
- Embedded data håndtering

# Anvendelse
Brug samme shortcode:
- [vis_news_dk_data]

# Installation
- Vælg hvilken test du vil implementere
- Kopier koden til dit WordPress-tema
- Opdater API-credentials
- Brug shortcode på ønsket side

# Sikkerhed
Begge tests inkluderer:
- Basic authentication
- Escapening af output
- Sikker URL-håndtering




