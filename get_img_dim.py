from PIL import Image
try:
    with Image.open(r'c:\PROJECT\alumni-system\public\images\hero-bg.png') as img:
        print(f"Width: {img.width}, Height: {img.height}")
except Exception as e:
    print(f"Error: {e}")
