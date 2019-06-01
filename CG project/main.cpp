#define _CRT_NONSTDC_NO_DEPRECATE
#ifndef _GLIBCXX_NO_ASSERT
#include <cassert>
#endif

#include <cctype>
#include <cerrno>
#include <cfloat>
#include <ciso646>
#include <climits>
#include <clocale>
#include <cmath>
#include <csetjmp>
#include <csignal>
#include <cstdarg>
#include <cstddef>
#include <cstdio>
#include <cstdlib>
#include <cstring>
#include <ctime>

#if __cplusplus >= 201103L
#include <ccomplex>
#include <cfenv>
#include <cinttypes>
#include <cstdalign>
#include <cstdbool>
#include <cstdint>
#include <ctgmath>
#include <cwchar>
#include <cwctype>
#endif

// C++
#include <algorithm>
#include <bitset>
#include <complex>
#include <deque>
#include <exception>
#include <fstream>
#include <functional>
#include <iomanip>
#include <ios>
#include <iosfwd>
#include <iostream>
#include <istream>
#include <iterator>
#include <limits>
#include <list>
#include <locale>
#include <map>
#include <memory>
#include <new>
#include <numeric>
#include <ostream>
#include <queue>
#include <set>
#include <sstream>
#include <stack>
#include <stdexcept>
#include <streambuf>
#include <string>
#include <typeinfo>
#include <utility>
#include <valarray>
#include <vector>

#if __cplusplus >= 201103L
#include <array>
#include <atomic>
#include <chrono>
#include <condition_variable>
#include <forward_list>
#include <future>
#include <initializer_list>
#include <mutex>
#include <random>
#include <ratio>
#include <regex>
#include <scoped_allocator>
#include <system_error>
#include <thread>
#include <tuple>
#include <typeindex>
#include <type_traits>
#include <unordered_map>
#include <unordered_set>
#endif
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<GL\glut.h>
#include<GL/freeglut.h>
#include <chrono>
#include <thread>
#include <fstream>
#include <string>
#include <sstream> 
int animate = 0;
const int N = 50; int n = 0;
int animen = 0;
using namespace std;
using namespace std::chrono;
using namespace std::this_thread;     // sleep_for, sleep_until
using namespace std::chrono_literals; // ns, us, ms, s, h, etc.
using std::chrono::system_clock;
#define MAX 50		// Number of values in the array
#define SPEED 15000	// Speed of sorting, must be greater than MAX always
int a[MAX];
int b[MAX];// Array
int swapflag = 0;		// Flag to check if swapping has occured
int i = 0, j = 0;		// To iterate through the array
int k = 0;			// To Switch from Welcome screen to Main Screen
int sorting = 0;		// 1 if Sorted
char m1[] = "Bubble Sort";
char m2[] = "Selection Sort";
char m3[] = "Insertion Sort";
char m4[] = "Ripple Sort";
char m5[] = "Oddeven Sort";
const char *sort_string[] = { m1,m2,m3,m4,m5 };
int sort_count = 0;	// To cycle through the string
int drawpoints = 0;
int grid = 0;
int maxx = 20;
int maxy = 10;
float x[MAX] = {  };
float y[MAX] = {  };
int v[MAX] = { };
float dist[50] = {};
static int window;
static int menu_id;
static int submenu_id;
static int value = 0;
int testpoint = 0;
float testx, testy;
int lineanimate = 0;
//for animation tp take place
int lineanimation = 0;
int greatx = 0, greaty = 0;
int drawlines = 0;
void output();
void display1();
int result;
int drawcircleflag = 0;

void findxy() {
	greatx = x[0];
	greaty = y[0];
	for (int i = 0; i < n; i++) {

		if (greatx < x[i])
			greatx = x[i];
		if (greaty < y[i])
			greaty = y[i];
	}
}
struct Point
{
	int val;     // Group of point 
	double x, y;     // Co-ordinate of point 
	double distance; // Distance from test point 
};


// Function to display text on screen char by char
void bitmap_output(int x, int y, char *string, void *font)
{
	int len, i;

	glRasterPos2f(x, y);
	len = (int)strlen(string);
	for (i = 0; i < len; i++) {
		glutBitmapCharacter(font, string[i]);
	}
}

void int_str(int rad, char r[])
{
	snprintf(r, 10, "%d", rad);
}
void float_str(float rad, char r[])
{
	snprintf(r, 10, "%f", rad);
}

//2ND open window

void drawpoint() {
	float tempx = 650 / greatx;
	float tempy = 750 / greaty;
	glPointSize(10);
	char text[10];
	int s = 7;

	for (int i = 0; i < n; i++)
	{
		glBegin(GL_TRIANGLES);
		if (v[i] == 0) {
			glColor3f(0.2, 0.3, 1.0);
			int_str(0, text);
			glVertex2f(20 + tempx * x[i], 20 + tempy * y[i] - s);
			glVertex2f(20 + tempx * x[i] + s, 20 + tempy * y[i] + s);
			glVertex2f(20 + tempx * x[i] - s, 20 + tempy * y[i] + s);
		}
		else
		{
			int_str(1, text);
			glColor3f(0.1, 1.0, 0.6);
			glVertex2f(20 + tempx * x[i], 20 + tempy * y[i] + s);
			glVertex2f(20 + tempx * x[i] - s, 20 + tempy * y[i] - s);
			glVertex2f(20 + tempx * x[i] + s, 20 + tempy * y[i] - s);
		}

		glEnd();

		char val[10] = "val=";
		glColor3f(1.0, 1.0, 1.0);
		bitmap_output(26 + tempx * x[i], tempy * y[i], text, GLUT_BITMAP_TIMES_ROMAN_10);
		bitmap_output(12 + tempx * x[i], tempy * y[i], val, GLUT_BITMAP_TIMES_ROMAN_10);
	}



}
void circle(float x,float y ,float r) {
	double twicePi = 2.0 * 3.142;
	glBegin(GL_LINE_LOOP); //BEGIN CIRCLE
	//glVertex2f(x, y); // center of circle
	for (i = 0; i <= 20; i++) {
		glVertex2f(
			(x + (r * cos(i * twicePi / 21))), (y + (r * sin(i * twicePi / 21)))
		);
	}
	glEnd(); //END

}
void drawcircle()
{
	glLineWidth(2);
	glColor3f(1.0, 1.0, 0.5);
	float tempx = 650 / greatx;
	float tempy = 750 / greaty;
	char dis[10] = "k=";
	char txt[10];
	float x = testx*tempx+20, y = testy*tempy+20;
	int radius ;
	for (int i = 1; i < n; i++) {
		
		radius = tempx * i;
		circle(x, y, radius);
		int_str(i, txt);
		dis[2] = txt[0];
	
		bitmap_output(x+radius/2-(i*5), y+radius-i*5, dis, GLUT_BITMAP_TIMES_ROMAN_10);
	}
	
}
void drawline() {
	char txt[10];
	char dis[10] = "dist=";
	float tempx = 650 / greatx;
	float tempy = 750 / greaty;
	glLineWidth(3);
	glColor4f(1.0, 1.0, 0, 1);
	for (int i = 0; i < lineanimate; i++) {
		glColor4f(1.0, 1.0, 0, 1);
		glBegin(GL_LINES);
		glVertex2f(20 + tempx * x[i], 20 + tempy * y[i]);
		glVertex2f(20 + tempx * testx, 20 + tempy * testy);
		glEnd();
		float_str(dist[i], txt);
		dis[5] = txt[0];
		dis[6] = txt[1];
		dis[7] = txt[2];
		glColor4f(1.0, 1.0, 1.0, 1);
		bitmap_output((tempx * x[i] + tempx * testx) / 2 - 20, (tempy * y[i] + tempy * testy) / 2 - 5, dis, GLUT_BITMAP_TIMES_ROMAN_10);
	}

}

void front()
{
	char jss[] = "JSS ACADEMY OF TECHNICAL EDUCATION";
	char cse[] = "COMPUTER SCIENCE DEPARTMENT";
	char guide[] = "UNDER THE GUIDANCE OF:-";
	char pname1[] = "COMPUTER GRAPHICS MINI PROJECT";
	char pname[] = "THE TOPIC: \" KNN ALGORITHM VISUALIZATION\"";
	char done[] = "SUBMITTED BY:-";
	char sname1[] = "PREETHAM D P";
	char sname2[] = "SHRAVANTH V Y";
	char sname3[] = "MR MAHESH KUMAR";
	glClearColor(0.8, 0.8, 0.8, 1.0);
	glColor3f(0.8, 0.2, 0.2);
	bitmap_output(170, 565, jss, GLUT_BITMAP_TIMES_ROMAN_24);

	bitmap_output(180, 530, pname1, GLUT_BITMAP_TIMES_ROMAN_24);
	bitmap_output(130, 495, pname, GLUT_BITMAP_TIMES_ROMAN_24);

	glColor3f(1.0, 0.5, 0.5);
	glBegin(GL_QUADS);
	glVertex2f(520, 250.0); glVertex2f(520, 300); glVertex2f(700, 300); glVertex2f(700, 250);
	glEnd();
	glColor3f(1.0, 1.0, 0.5);
	char t16[] = "Press Enter to continue.......";
	bitmap_output(530, 260, t16, GLUT_BITMAP_HELVETICA_18);
	glColor3f(0.5, 0.5, 0.5);
	bitmap_output(10, 170, done, GLUT_BITMAP_HELVETICA_18);
	glColor3f(1.0, 0.5, 0.5);
	bitmap_output(10, 125, sname1, GLUT_BITMAP_HELVETICA_18);
	bitmap_output(10, 90, sname2, GLUT_BITMAP_HELVETICA_18);
	char t19[] = ": 1JS16CS085";
	bitmap_output(170, 90, t19, GLUT_BITMAP_HELVETICA_18);
	char t20[] = ": 1JS16CS074";
	bitmap_output(170, 125, t20, GLUT_BITMAP_HELVETICA_18);
	glColor3f(0.5, 0.5, 0.5);
	bitmap_output(450, 170, guide, GLUT_BITMAP_HELVETICA_18);
	glColor3f(1.0, 0.5, 0.5);
	bitmap_output(450, 125, sname3, GLUT_BITMAP_HELVETICA_18);
}

void Initialize() {
	int temp1;

	// Reset the array
	for (temp1 = 0; temp1 < MAX; temp1++) {
		a[temp1] = temp1 + 1;
		b[temp1] = temp1 + 1;
	}

	// Reset all values
	i = j = 0;

	glClearColor(1, 1, 1, 1);
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	gluOrtho2D(0, 699, 0, 799);
}
void changepointcolor() {

}

// Return 1 if not sorted
int notsorted() {
	int q;
	for (q = 0; q < MAX - 1; q++)
	{
		if (a[q] > a[q + 1])
			return 1;
	}
	return 0;
}

// Main function for display
void display()
{
	glClearColor(0.0, 0.0, 0.0, 1.0);
	int ix, temp;
	glClear(GL_COLOR_BUFFER_BIT);

	if (k == 0)
	{
		front();

	}
	else {
		char text[10];
		glColor3f(0.2, 0.2, 0.2);
		glBegin(GL_QUADS);
		glVertex2d(10, 10);
		glVertex2d(690, 10);
		glVertex2d(690, 790);
		glVertex2d(10, 790);
		glEnd();

		glLineWidth(3);
		glBegin(GL_LINES);
		glColor3f(1.0, 0.5, 0.1);
		glVertex2i(20, 20);
		glColor3f(0.7, 0.2, 0.5);
		glVertex2i(680, 20);
		glColor3f(1.0, 0.5, 0.1);
		glVertex2i(20, 20);
		glColor3f(0.7, 0.2, 0.5);
		glVertex2i(20, 780);
		glEnd();
		float temp = 650 / greatx;
		float tempy = 750 / greaty;
		float temp1 = temp, temp2 = tempy;


		if (grid == 1)

		{
			for (ix = 0; ix < animen; ix++)
			{

				
				glColor4f(0.0, 1.0, 0.0, 0.1);
				glLineWidth(0.5);
				glBegin(GL_LINES);
				glVertex2i(temp + 20, 20);
				glColor4f(1.0, 0.0, 0.0, 0.1);
				glVertex2f(temp + 20, 780);
				glColor4f(0.0, 1.0, 0.0, 0.1);
				glVertex2f(20, 20 + tempy);
				glColor4f(1.0, 0.0, 0.0, 0.1);
				glVertex2f(680, 20 + tempy);
				glEnd();

				//drawpoint(temp + 20, tempy + 20);
				temp += temp1;
				tempy += temp2;


				int_str(a[ix], text);
				//printf("\n%s",text);
				glColor3f(1.0, 1.0, 1.0);
				bitmap_output(temp1*ix + temp1 + 20, 5, text, GLUT_BITMAP_TIMES_ROMAN_10);
				int_str(b[ix], text);
				bitmap_output(10, temp2*ix + temp2 + 20, text, GLUT_BITMAP_TIMES_ROMAN_10);
				int_str(0, text);
				bitmap_output(10, 10, text, GLUT_BITMAP_TIMES_ROMAN_10);
			}
		}
		
		if (drawpoints == 1)
		{
			glColor4f(0, 0, 0, 1);
			drawpoint();
		}
		if (testpoint)
		{
			float tempx = 650 / greatx;
			float tempy = 750 / greaty;
			glPointSize(20);
			int s = 15;
			glBegin(GL_QUADS);
			glColor4f(0.5, 0.0, 0.5, 1.0);
			glVertex2f(20 + tempx * testx, 20 + tempy * testy - s);
			glVertex2f(20 + tempx * testx + s, 20 + tempy * testy);
			glVertex2f(20 + tempx * testx, 20 + tempy * testy + s);
			glVertex2f(20 + tempx * testx - s, 20 + tempy * testy);
			glEnd();
		}
		if (drawlines && drawpoints && testpoint) {
			drawline();
			changepointcolor();
		}
		if (drawpoints && testpoint && drawcircleflag) {
			
			drawcircle();
		}
		
	}
	glFlush();
}
void animation(int anime) {
	switch (anime) {
	case 1:if (n > animen) {
		animen += 1;
	}
		   else {
		animate = 0;
	}
		   break;
	case 2:if (n > lineanimate) {
		lineanimate += 1;

	}
		   else {
		lineanimation = 0;
	}
		   break;

	}

}
// Timer Function, takes care of sort selection
void makedelay(int)
{
	if (animate == 1 && grid == 1)
	{
		animation(1);

	}
	if (lineanimation == 1) {
		animation(2);
	}

	glutPostRedisplay();
	glutTimerFunc(SPEED / MAX, makedelay, 1);
}

// Keyboard Function
void keyboard(unsigned char key, int x, int y)
{
	if (key == 13)
		k = 1;
	
}
bool comparison(Point a, Point b)
{
	return (a.distance < b.distance);
}
// This function finds classification of point p using 
// k nearest neighbour algorithm. It assumes only two 
// groups and returns 0 if p belongs to group 0, else 
// 1 (belongs to group 1). 

int classifyAPoint(Point arr[], int n, int k, Point p)
{
	// Fill distances of all points from p 
	cout << "feature1\t" << "feature2\t" << "value\t" << "distance from test point\n" << endl;
	for (int i = 0; i < n; i++)
	{
		arr[i].distance =
			sqrt((arr[i].x - p.x) * (arr[i].x - p.x) +
			(arr[i].y - p.y) * (arr[i].y - p.y));
		//cout << arr[i].distance<<endl;
		dist[i] = arr[i].distance;
		cout << arr[i].x << "\t|\t" << arr[i].y << "\t|\t" << arr[i].val << "\t|\t" << arr[i].distance << endl;
	}

	sort(arr, arr + n, comparison);
	cout << "\n================================================================\nAfter sorting according to the distace\n";
	cout << "feature1\t" << "feature2\t" << "value\t" << "distance from test point\n" << endl;
	for (int i = 0; i < n; i++) {
		cout << arr[i].x << "\t|\t" << arr[i].y << "\t|\t" << arr[i].val << "\t|\t" << arr[i].distance << endl;
	}
	
	int freq1 = 0;     // Frequency of group 0 
	int freq2 = 0;     // Frequency of group 1 
	for (int i = 0; i < k; i++)
	{
		if (arr[i].val == 0)
			freq1++;
		else if (arr[i].val == 1)
			freq2++;
	}
	//cout << freq1 << endl << freq2 << endl;
	return (freq1 > freq2 ? 0 : 1);
}


void menu(int num) {
	if (num == 0) {
		glutDestroyWindow(window);
		exit(0);
	}
	else if (num == 3) {
		drawpoints = 1;
	}
	else if (num == 2) {
		grid = 1;
		animate = 1;
	}
	else if (num == 1) {
		grid = drawpoints = 0;
		animate = 0;
		testpoint = 0;
		lineanimation = 0;
		drawlines = 0;
		//for animation to work
		animen = 0;
		drawcircleflag = 0;
	}
	else if (num == 4) {
		testpoint = 1;
	}
	else if (num == 5) {
		if (drawpoints) {
			lineanimation = 1;
			drawlines = 1;
		}

	}
	else if (num == 6) {
		if (drawlines||drawcircleflag)
			output();
	}
	else if (num == 7) {
		if (drawpoints&&testpoint)
			drawcircleflag = 1;
	}
	glutPostRedisplay();
}
void createMenu(void) {

	menu_id = glutCreateMenu(menu);
	glutAddMenuEntry("Clear", 1);
	glutAddMenuEntry("Grid", 2);
	glutAddMenuEntry("Training Points", 3);
	glutAddMenuEntry("Testing Point", 4);
	glutAddMenuEntry("Execute 1", 5);
	glutAddMenuEntry("Execute 2", 7);
	glutAddMenuEntry("Output", 6);
	glutAddMenuEntry("Quit", 0);
	glutAttachMenu(GLUT_RIGHT_BUTTON);
}
// Main Function
void output()
{
	glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
	glutInitWindowSize(500, 500);
	glutInitWindowPosition(1010, 100);
	glutCreateWindow("OUTPUT");
	glClear(GL_COLOR_BUFFER_BIT);
	glClearColor(0.5, 0.5, 1, 1);
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	gluOrtho2D(0, 699, 0, 799);
	glutDisplayFunc(display1);

}
void main(int argc, char **argv)
{
	glutInit(&argc, argv);

	int i = 0;
	Point arr[N];
	string line1, line2, line3;
	fstream myfile("x.txt");

	if (myfile.is_open())                     //if the file is open
	{
		while (!myfile.eof())                 //while the end of file is NOT reached
		{
			getline(myfile, line1);
			//get one line from the file
		   //cout << line << endl; 
		   // object from the class stringstream 

			stringstream geek(line1);
			geek >> x[i];
			i++;

		}
		myfile.close();                         //closing the file
	}
	fstream myfiley("y.txt");

	if (myfiley.is_open())                     //if the file is open
	{
		int j = 0;
		while (!myfiley.eof())                 //while the end of file is NOT reached
		{

			getline(myfiley, line2);
			//get one line from the file
				   //cout << line << endl; 
				   // object from the class stringstream 

			stringstream geek(line2);
			geek >> y[j];
			j++;

		}

		myfiley.close();                         //closing the file
	}
	fstream myfileval("val.txt");
	if (myfileval.is_open())                     //if the file is open
	{
		int z = 0;
		while (!myfileval.eof())                 //while the end of file is NOT reached
		{

			getline(myfileval, line3); //get one line from the file
			//cout << line << endl; 
			// object from the class stringstream 

			stringstream geek(line3);
			geek >> v[z];
			
			z++;

		}

		myfileval.close();                         //closing the file
	}
	else cout << "Unable to open file";       //if the file is not open output 
	//global
	n = i;
	i = 0;
	system("PAUSE");

	for (i = 0; i < n; i++)
	{
		arr[i].x = x[i];
		arr[i].y = y[i];
		arr[i].val = v[i];
		//cin >> arr[i].x;
	}
	
	Point p;
	printf("Enter the testing features\n");
	cin >> p.x >> p.y;
	testx = p.x;
	testy = p.y;

	// Parameter to decide groupr of the testing point 
	int k = 5;
	result = classifyAPoint(arr, n, k, p);
	printf("The value classified to unknown point (%f,%f)"
		" is %d.\n", testx, testy, result);
	//return 0;
	findxy();

	glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
	glutInitWindowSize(1000, 600);
	glutInitWindowPosition(0, 0);
	glutCreateWindow("KNN ALGORITHM VISUALIZATION");
	Initialize();
	createMenu();
	glutDisplayFunc(display);
	glutKeyboardFunc(keyboard);
	glutTimerFunc(1000, makedelay, 1);
	glutMainLoop();
}
void display1() {
	glColor3f(0.5, 0.5, 1);
	glBegin(GL_QUADS);
	glVertex2i(0, 0);
	glVertex2i(699, 0);
	glVertex2i(699, 799);
	glVertex2i(0, 799);
	glEnd();
	glColor3f(0.0, 0.0, 0.1);
	glBegin(GL_QUADS);
	glVertex2i(100, 100);
	glVertex2i(600, 100);
	glVertex2i(600, 700);
	glVertex2i(100, 700);
	glEnd();
	char val1[] = "BLUE (0)";
	char val2[] = "GREEN (1)";
	glColor3f(0.0, 1.0, 0.0);
	if (result == 0)
	{
		glColor3f(0.0, 0.0, 1.0);
		bitmap_output(225, 400, val1, GLUT_BITMAP_HELVETICA_18);
	}
	else
		bitmap_output(225, 400, val2, GLUT_BITMAP_HELVETICA_18);
	glColor3f(1.0, 1.0, 1.0);
	char t1[] = "The unknown features ";
	bitmap_output(150, 600, t1, GLUT_BITMAP_HELVETICA_18);
	char t2[] = "is classified as ";
	bitmap_output(150, 500, t2, GLUT_BITMAP_HELVETICA_18);
	char t3[] = "group ";
	bitmap_output(150, 400, t3, GLUT_BITMAP_HELVETICA_18);
	

}