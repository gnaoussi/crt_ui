from PIL import Image
import colorsys

# Open original image
img_path = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/mockup/login-img.png'
img = Image.open(img_path).convert('RGBA')

pixels = img.load()
width, height = img.size

# Target CRT Cyan Hue is around 175-182 degrees => HSV Hue ~ 0.48 - 0.50
# Original Blue Hues are around 195-215 degrees => HSV Hue ~ 0.54 - 0.60

for y in range(height):
    for x in range(width):
        r, g, b, a = pixels[x, y]
        if a == 0:
            continue
        
        # Convert RGB to HSV
        r_n, g_n, b_n = r / 255.0, g / 255.0, b / 255.0
        h, s, v = colorsys.rgb_to_hsv(r_n, g_n, b_n)
        
        # Target blue/light-blue range (H between 0.51 and 0.65)
        if 0.50 <= h <= 0.65 and s > 0.15:
            # Shift hue to CRT Cyan / Teal-Green (0.485)
            new_h = 0.485
            # Slightly boost saturation for rich CRT Teal-Green tone
            new_s = min(1.0, s * 1.05)
            new_r, new_g, new_b = colorsys.hsv_to_rgb(new_h, new_s, v)
            pixels[x, y] = (int(new_r * 255), int(new_g * 255), int(new_b * 255), a)

# Save output to root and laravel/public
out_path_root = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/login-img.png'
out_path_laravel = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/public/login-img.png'

img.save(out_path_root, 'PNG')
img.save(out_path_laravel, 'PNG')

print("SUCCESS: login-img.png recolored with CRT Cyan / Teal-Green palette!")
