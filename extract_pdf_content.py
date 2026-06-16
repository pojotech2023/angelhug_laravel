#!/usr/bin/env python3
"""
PDF Content Extractor for Medical Coding Website

This script extracts text content from the website model content PDF
and organizes it for use in Laravel blade templates.

Usage: python extract_pdf_content.py

Requirements: pip install PyPDF2 or pip install pdfplumber
"""

import os
import sys

def extract_with_pypdf2():
    """Extract content using PyPDF2 library"""
    try:
        import PyPDF2
        
        pdf_path = r"c:\Users\divya\laravel_projects\sarahimi-medical-coding\website model content.pdf"
        
        with open(pdf_path, 'rb') as file:
            reader = PyPDF2.PdfReader(file)
            
            print("=== PDF CONTENT EXTRACTION ===")
            print(f"Total pages: {len(reader.pages)}")
            print("\n" + "="*50)
            
            all_text = ""
            for page_num, page in enumerate(reader.pages, 1):
                text = page.extract_text()
                print(f"\n--- PAGE {page_num} ---")
                print(text)
                all_text += f"\n\n--- PAGE {page_num} ---\n{text}"
            
            # Save extracted content to file
            output_path = r"c:\Users\divya\laravel_projects\sarahimi-medical-coding\extracted_content.txt"
            with open(output_path, 'w', encoding='utf-8') as output_file:
                output_file.write(all_text)
            
            print(f"\n\nContent saved to: {output_path}")
            
    except ImportError:
        print("PyPDF2 not installed. Install with: pip install PyPDF2")
        return False
    except Exception as e:
        print(f"Error with PyPDF2: {e}")
        return False
    
    return True

def extract_with_pdfplumber():
    """Extract content using pdfplumber library (often better for tables/layouts)"""
    try:
        import pdfplumber
        
        pdf_path = r"c:\Users\divya\laravel_projects\sarahimi-medical-coding\website model content.pdf"
        
        with pdfplumber.open(pdf_path) as pdf:
            print("=== PDF CONTENT EXTRACTION (PDFPlumber) ===")
            print(f"Total pages: {len(pdf.pages)}")
            print("\n" + "="*50)
            
            all_text = ""
            for page_num, page in enumerate(pdf.pages, 1):
                text = page.extract_text()
                if text:
                    print(f"\n--- PAGE {page_num} ---")
                    print(text)
                    all_text += f"\n\n--- PAGE {page_num} ---\n{text}"
                
                # Check for tables
                tables = page.extract_tables()
                if tables:
                    print(f"\n--- TABLES ON PAGE {page_num} ---")
                    for i, table in enumerate(tables):
                        print(f"Table {i+1}:")
                        for row in table:
                            print(" | ".join(str(cell) if cell else "" for cell in row))
                        print()
            
            # Save extracted content to file
            output_path = r"c:\Users\divya\laravel_projects\sarahimi-medical-coding\extracted_content.txt"
            with open(output_path, 'w', encoding='utf-8') as output_file:
                output_file.write(all_text)
            
            print(f"\n\nContent saved to: {output_path}")
            
    except ImportError:
        print("pdfplumber not installed. Install with: pip install pdfplumber")
        return False
    except Exception as e:
        print(f"Error with pdfplumber: {e}")
        return False
    
    return True

def main():
    """Main extraction function"""
    print("PDF Content Extractor for Medical Coding Website")
    print("=" * 50)
    
    # Try pdfplumber first (often better for structured content)
    if extract_with_pdfplumber():
        print("\nExtraction completed successfully with pdfplumber!")
        return
    
    # Fallback to PyPDF2
    if extract_with_pypdf2():
        print("\nExtraction completed successfully with PyPDF2!")
        return
    
    print("\nNo PDF libraries available. Please install either:")
    print("  pip install pdfplumber")
    print("  or")
    print("  pip install PyPDF2")

if __name__ == "__main__":
    main()