from PIL import Image
import colorsys

img_path = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/mockup/login-img.png'
img = Image.open(img_path).convert('RGBA')

pixels = img.load()
width, height = img.size

# Process light blue pixels into a deep, elegant, non-glare CRT Cyan / Emerald (#008C97 / #065F66)
for y in range(height):
    for x in range(width):
        r, g, b, a = pixels[x, y]
        if a == 0:
            continue
        
        r_n, g_n, b_n = r / 255.0, g / 255.0, b / 255.0
        h, s, v = colorsys.rgb_to_hsv(r_n, g_n, b_n)
        
        # Target light blue/cyan pixels
        if 0.48 <= h <= 0.65 and s > 0.10:
            new_h = 0.485 # CRT Cyan/Teal
            new_s = min(1.0, s * 1.15) # Boost saturation slightly
            new_v = v * 0.62 # Lower brightness by 38% for deep, resting contrast
            new_r, new_g, new_b = colorsys.hsv_to_rgb(new_h, new_s, new_v)
            pixels[x, y] = (int(new_r * 255), int(new_g * 255), int(new_b * 255), a)

out_path_root = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/login-img.png'
out_path_laravel = '/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/laravel/public/login-img.png'

img.save(out_path_root, 'PNG')
img.save(out_path_laravel, 'PNG')
print("SUCCESS: login-img.png recolored with deep, dark CRT Cyan / Emerald tone!")
